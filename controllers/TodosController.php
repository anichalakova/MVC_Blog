<?php
/**
 * Created by PhpStorm.
 * User: Ani
 * Date: 5/2/15
 * Time: 2:34 AM
 */

class TodosController extends BaseController{
    private $todosModel;

    protected function onInit() {
        $this->title = 'TODOs';
        $this->todosModel = new TodosModel();
    }

    public function index($page=1, $pageSize=5) {
        $this->authorize();
        $this->page = $page; //
        $this->pageSize = $pageSize; //
        $this->todos = $this->todosModel->getAllWithPaging($page, $pageSize);
        $this->page = $page;
        $this->pageSize=$pageSize;
        $this->totalTodosNumber=count($this->todosModel->getAll());
        $this->renderView();
    }

    public function create() {
        $this->authorize();
        if ($this->isPost()) {
            $todo_text = $_POST['todo_text'];
            if ($this->todosModel->create($todo_text)) {
                $this->addInfoMessage("TODO created.");
                $this->redirect('todos', 'index');
            } else {
                $this->addErrorMessage("Cannot create TODO.");
            }
        }
        $this->renderView(__FUNCTION__); //_FUNCTION_ holds the name of the current method, here - "create"
    }

    public function edit($id) {
        $this->authorize();
        if ($this->isPost()) {
            // Edit the TODO in the database
            $todo_item = $_POST['todo_item'];
            if ($this->todosModel->edit($id, $todo_item)) {
                $this->addInfoMessage("TODO edited.");
                $this->redirect('todos', 'index');
            } else {
                $this->addErrorMessage("Cannot edit TODO.");
            }
        }

        // Display edit TODO form
        $this->todo = $this->todosModel->find($id);
        if (!$this->todo) {
            $this->addErrorMessage("Invalid TODO.");
            $this->redirect('todos', 'index');
        }

        $this->renderView(__FUNCTION__);
    }

    public function delete($id) {
        $this->authorize();
        if ($this->todosModel->delete($id)) {
            $this->addInfoMessage("TODO deleted.");
        } else {
            $this->addErrorMessage("Cannot delete TODO #" . htmlspecialchars($id) . '.');
            $this->addErrorMessage("Maybe it is in use.");
        }
        $this->redirect('todos', 'index');
    }
} 