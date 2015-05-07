<?php
/**
 * Created by PhpStorm.
 * User: Ani
 * Date: 5/7/15
 * Time: 1:47 AM
 */

class ReadController extends BaseController {
    private $postModel;

    protected function onInit() {
        $this->title = 'MVC_Blog';
        $this->postModel = new PostModel();
    }

    public function index($id) {
        $this->id = $id; //
        $this->post = $this->postModel->find($id);


//        for ($i = 0; $i < count($this->posts); $i++) {
//            $currentPost = $this->viewBag['posts'][$i];
//            $currentPost['date'] = date_format(date_create($currentPost['date']), "d M Y");
//            $this->viewBag['posts'][$i]['date'] = $currentPost['date'];
//        }

        $this->renderView();
    }
} 