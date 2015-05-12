<?php
/**
 * Created by PhpStorm.
 * User: Ani
 * Date: 5/2/15
 * Time: 2:01 AM
 */

class AccountController extends BaseController {
    private $accountModel;

    protected function onInit() {
        $this->accountModel = new AccountModel();
    }

    public function register(){
        if ($this->isPost()) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($username == null || strlen($username) < 3) {
                $this->addErrorMessage("Username must have at least 3 symbols!");
                $this->redirect('account', 'register');
            }

            $registrationResult = $this->accountModel->register($username, $password);
            if ($registrationResult) {
                $_SESSION['username'] = $username;
                unset($_SESSION['isAdmin']);
                $_SESSION['userId']= $this->accountModel->login($username, $password);
                $this->redirect('home', 'index');
            } else{
                $this->addErrorMessage("Registration failed!");
            }
        }
        $this->title = 'Register';
        $this->renderView(__FUNCTION__);

    }

    public function login(){
        if ($this->isPost()) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($username == null || strlen($username) < 3) {
                $this->addErrorMessage("Username must have at least 3 symbols!");
                return $this->redirect('account', 'login');
            }

            $isLoggedin = $this->accountModel->login($username, $password);
            if ($isLoggedin) {
                $_SESSION['username'] = $username;
                $_SESSION['userId']= $isLoggedin;
                $this->addInfoMessage('Logged in!');
                $this->redirect('home', 'index');
            } else{
                $this->addErrorMessage("Login failed!");
            }
        }
        $this->title = 'Login';
        $this->renderView(__FUNCTION__);

    }

    public function logout(){
        unset($_SESSION['username']);
        unset($_SESSION['userId']);
        unset($_SESSION['isAdmin']);
        $this->addInfoMessage("Logout successful.");
        $this -> redirect('home', 'index');
    }
} 