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

        $this->renderView();
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