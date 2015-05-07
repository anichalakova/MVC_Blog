<?php

class HomeController extends BaseController {
    private $postModel;

    protected function onInit() {
        $this->title = 'MVC_Blog';
        $this->postModel = new PostModel();
    }

    public function index($page=1, $pageSize=5) {
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
}