<?php
/**
 * Created by PhpStorm.
 * User: Ani
 * Date: 5/7/15
 * Time: 1:47 AM
 */

class ReadController extends BaseController {
    private $postModel;
    private $commentModel;

    protected function onInit() {
        $this->title = 'MVC_Blog';
        $this->postModel = new PostModel();
        $this->commentModel = new CommentModel();
    }

    public function index($id) {
        $this->id = $id; //
        $this->post = $this->postModel->find($id);
        $this->comments = $this->commentModel->getAllByPostId($id);

        $currentPost = $this->post;
        $currentPost['date']= date_format(date_create($this->post['date']), 'd M Y');
        $this->post = $currentPost;

        for ($i = 0; $i < count($this->comments); $i++) {
            $currentComment = $this->viewBag['comments'][$i];
            $currentComment['date'] = date_format(date_create($currentComment['date']), "d M Y H:i");
            $this->viewBag['comments'][$i]['date'] = $currentComment['date'];
        }
        $this->renderView();
        $this->postModel->incrementVisits($id);
    }

    public function comment($id) {
        $this->authorize();
        if ($this->isPost()) {
            // Leave a comment in the database
            $comment = $_POST['comment'];
            $post = $this->postModel->find($id);
            $userId = $_SESSION['userId'];
            if ($this->commentModel->create( $comment, $userId, $post['id'])) {
                $this->addInfoMessage("Comment published.");
                $this->redirect('read', 'index', [$id]);
            } else {
                $this->addErrorMessage("Cannot publish comment.");
            }
        }

        $this->renderView();
    }
} 