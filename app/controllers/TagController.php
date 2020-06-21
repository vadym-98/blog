<?php


namespace app\controllers;


use app\core\Controller;
use app\core\View;

class TagController extends Controller
{

    public function indexAction()
    {
        preg_match('/#(\w+)/', $_POST['tag'], $matches);
        $posts = $this->model->getAllPosts($matches[1]);
        $view = new View([
            'controller' => 'post',
            'action' => 'index'
        ]);
        $view->render('Blog', [
            'posts' => $posts
        ]);
    }
}