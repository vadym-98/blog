<?php


namespace app\controllers;


use app\core\Controller;

class UserController extends Controller
{

    public function createAction()
    {
        $this->view->render('Blog');
    }

    public function storeAction()
    {
        $this->model->addUser($this->validate($_POST));
    }

    public function logoutAction()
    {
        session_destroy();
        $this->view->redirect('/login');
    }

    public function loginAction()
    {
        $this->view->render('Blog');
    }

    public function authAction()
    {
        $userId = $this->model->existUser($this->validate($_POST));
        if (!empty($userId)) {
            $this->model->auth($userId[0]['id']);
        } else {
            echo json_encode(['error' => 'no such user']);
            exit(400);
        }
    }

    private function validate($data)
    {
        $userData['login'] = filter_var(trim($data['login']), FILTER_SANITIZE_STRING);
        $userData['password'] = filter_var($data['password'], FILTER_SANITIZE_STRING);
        if ($userData['login'] == '' || $userData['password'] == '') {
            echo json_encode(['error' => 'no empty fields']);
            exit(400);
        }
        if (!preg_match('/(\w+)@([a-z]+\.)([a-z]+)/', $userData['login'])) {
            echo json_encode(['error' => 'Invalid E-mail']);
            exit(400);
        }
        if ($_SERVER['REQUEST_URI'] === '/create-user' && !$this->model->isLoginUnique($userData['login'])) {
            echo json_encode(['error' => 'such user already exists']);
            exit(400);
        }
        $userData['password'] = md5($userData['password']);
        return $userData;
    }
}