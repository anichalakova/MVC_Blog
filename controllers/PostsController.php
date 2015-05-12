<?php

class PostsController extends BaseController{
    private $postModel;
    private $tagModel;

    protected function onInit() {
        $this->title = 'Home';
        $this->postModel = new PostModel();
        $this->tagModel = new TagModel();
    }

    public function index($page=1, $pageSize=5) {
        $this->authorizeAdmin();
        $this->page = $page;
        $this->pageSize = $pageSize;
        $this->posts = $this->postModel->getAllWithPaging($page, $pageSize);
        $this->page = $page;
        $this->pageSize=$pageSize;
        $this->totalpostsNumber=count($this->postModel->getAll());

        for ($i = 0; $i < count($this->posts); $i++) {
            $currentPost = $this->viewBag['posts'][$i];
            $currentPost['date'] = date_format(date_create($currentPost['date']), "d M Y");
            $this->viewBag['posts'][$i]['date'] = $currentPost['date'];

            $currentPost['tags'] = $this->tagModel->getAllByPostId($currentPost['id']);
            $this->viewBag['posts'][$i]['tags'] = $currentPost['tags'];
        }

        $this->renderView();
    }

    public function create() {
        $this->authorizeAdmin();

        if ($this->isPost()) {
            $title = $_POST['title'];
            $text = $_POST['text'];
            $tagsString = $_POST['tags'];
            $tags = preg_split("/[\s]+/", $tagsString);
            if ($this->postModel->create($title, $text)) {
                $insertId = $this->postModel->findLast()['id'];
                if ($this->tagModel->saveTags($tags, $insertId) && $this->tagModel->bindTagsToPost($tags, $insertId)) {
                    $this->addInfoMessage("Post published.");
                    $this->redirect('posts', 'index');
                } else {
                    $this->addErrorMessage("Cannot add tags to post.");
                }
            } else {
                $this->addErrorMessage("Cannot publish post.");
            }
        }
        $this->renderView(__FUNCTION__);
    }

    public function edit($id) {
        $this->authorizeAdmin();
        if ($this->isPost()) {
            // Edit the post in the database
            $title = $_POST['title'];
            $text = $_POST['text'];
            $tagsString = $_POST['tags'];
            $tags = preg_split("/[\s]+/", $tagsString);
            if ($this->postModel->edit($id, $title, $text)
                && $this->tagModel->saveTags($tags, $id)
                && $this->tagModel->bindTagsToPost($tags, $id)) {
                $this->addInfoMessage("Post edited.");
                $this->redirect('posts', 'index');
            } else {
                $this->addErrorMessage("Cannot edit post.");
            }
        }

        // Display edit post form
        $this->post = $this->postModel->find($id);
        $tags = $this->tagModel->getAllByPostId($id);
        $this->tags = $tags;
        if (!$this->post) {
            $this->addErrorMessage("Invalid post.");
            $this->redirect('posts', 'index');
        }
        $this->renderView(__FUNCTION__);
    }

    public function delete($id) {
        $this->authorizeAdmin();
        if ($this->postModel->delete($id)) {
            $this->addInfoMessage("Post deleted.");
        } else {
            $this->addErrorMessage("Cannot delete post #" . htmlspecialchars($id) . '.Maybe it is in use.');
        }
        $this->redirect('posts', 'index');
    }

    public function deleteTags($id) {
        $this->authorizeAdmin();
        if ($this->isPost()) {
            $tagsString = $_POST['remove-tags'];
            $tags = preg_split("/[\s]+/", $tagsString);
            foreach ($tags as $tag){
                if ($this->tagModel->deleteTagFromPost($tag, $id)) {
                    $this->addInfoMessage("Tag deleted.");
                } else {
                    $this->addErrorMessage("Cannot delete tag: " . htmlspecialchars($tag));
                }
            }
        }
        $this->redirect('posts', 'edit', [$id]);
    }
} 