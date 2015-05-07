<?php

class PostsController extends BaseController{
    private $postModel;

    protected function onInit() {
        $this->title = 'Home';
        $this->postModel = new PostModel();
    }

    public function index($page=1, $pageSize=5) {
        $this->authorize();
        $this->page = $page; //
        $this->pageSize = $pageSize; //
        $this->posts = $this->postModel->getAllWithPaging($page, $pageSize);
        $this->page = $page;
        $this->pageSize=$pageSize;
        $this->totalpostsNumber=count($this->postModel->getAll());

        for ($i = 0; $i < count($this->posts); $i++) {
            $currentPost = $this->viewBag['posts'][$i];
            $currentPost['date'] = date_format(date_create($currentPost['date']), "d M Y");
            $this->viewBag['posts'][$i]['date'] = $currentPost['date'];
        }

        $this->renderView();
    }

    public function create() {
        $this->authorize();
        if ($this->isPost()) {
            $title = $_POST['title'];
            $text = $_POST['text'];
            if ($this->postModel->create($title, $text)) {
                $this->addInfoMessage("Post published.");
                $this->redirect('posts', 'index');
            } else {
                $this->addErrorMessage("Cannot publish post.");
            }
        }
        $this->renderView(__FUNCTION__); //_FUNCTION_ holds the name of the current method, here - "create"
    }

    public function edit($id) {
        $this->authorize();
        if ($this->isPost()) {
            // Edit the post in the database
            $title = $_POST['title'];
            $text = $_POST['text'];
            if ($this->postModel->edit($id, $title, $text)) {
                $this->addInfoMessage("Post edited.");
                $this->redirect('posts', 'index');
            } else {
                $this->addErrorMessage("Cannot edit post.");
            }
        }

        // Display edit post form
        $this->post = $this->postModel->find($id);
        if (!$this->post) {
            $this->addErrorMessage("Invalid post.");
            $this->redirect('posts', 'index');
        }
        $this->renderView(__FUNCTION__);
    }

    public function delete($id) {
        $this->authorize();
        if ($this->postModel->delete($id)) {
            $this->addInfoMessage("Post deleted.");
        } else {
            $this->addErrorMessage("Cannot delete post #" . htmlspecialchars($id) . '.Maybe it is in use.');
        }
        $this->redirect('posts', 'index');
    }
} 