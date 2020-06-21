<?php


namespace app\controllers;


use app\core\Controller;
use app\models\Comment;
use app\models\Tag;
use app\models\User;

class PostController extends Controller
{
    public function indexAction()
    {
        if (!isset($_SESSION['user'])) $this->view->redirect('/login');
        $posts = $this->model->all();
        $this->view->render('Blog', [
            'posts' => $posts
        ]);
    }

    public function showAction()
    {
        $post = $this->model->getPost($this->route['post']);
        $user = User::getUser($post[0]['user_id']);
        $comments = Comment::getComments($post[0]);
        $this->view->render('Blog', [
            'post' => $post,
            'user' => $user[0],
            'comments' => $comments
        ]);
    }

    public function destroyAction()
    {
        $this->checkAuthorisation();
        $this->model->deletePost($this->route['post']);
        $this->view->redirect('/');
    }

    public function createAction()
    {
        $this->view->render('Blog', [
            'tags' => Tag::all()
        ]);
    }

    public function storeAction()
    {
        $this->model->addPost($this->validate($_POST), $_SESSION['user'][0]);
    }

    public function editAction()
    {
        $this->checkAuthorisation();
        $post = $this->model->getPost($this->route['post']);
        $this->view->render('Blog', [
            'post' => $post,
            'tags' => Tag::all()
        ]);
    }

    public function updateAction()
    {
        $this->checkAuthorisation();
        $this->model->editPost($this->validate($_POST));
    }

    private function validate($data)
    {
        $postData['id'] = isset($data['id']) ? $data['id'] : 0;
        $postData['title'] = filter_var(trim($data['title']), FILTER_SANITIZE_STRING);
        $postData['content'] = filter_var(trim($data['content']), FILTER_SANITIZE_STRING);
        $postData['status'] = filter_var(trim($data['status']), FILTER_SANITIZE_STRING);
        if ($postData['title'] === '' || $postData['content'] === '' ||
            $postData['status'] === '' || !isset($data['id']) && empty($_FILES)) {
            echo json_encode(['error' => 'no empty fields']);
            exit(400);
        }
        $postData['tags'] = isset($data['tags']) ? $data['tags'] : null;
        if (strlen($postData['title']) > 255) {
            echo json_encode(['error' => 'Title length must be 255 maximum']);
            exit(400);
        }
        if (!$this->model->isTitleUnique($postData['title'], $postData['id'])) {
            echo json_encode(['error' => 'Such title already exists']);
            exit(400);
        }
        if (strlen($postData['content']) < 50) {
            echo json_encode(['error' => 'Number of characters must be more than 50']);
            exit(400);
        }
        if (!isset($data['id'])) {
            $postData['image'] = $this->validateImage($_FILES);
        }
        return $postData;
    }

    private function validateImage($image)
    {
        // Массив допустимых значений типа файла
        $types = array('image/gif', 'image/png', 'image/jpeg');
        // Максимальный размер файла
        $size = 1024000;
        if (!in_array($_FILES[0]['type'], $types)) {
            echo json_encode(['error' => 'Invalid file type']);
            exit(400);
        }
        if ($_FILES[0]['size'] > $size) {
            echo json_encode(['error' => 'File is too large']);
            exit(400);
        }
        if (!copy($_FILES[0]['tmp_name'], 'images/' . $_FILES[0]['name'])) {
            echo json_encode(['error' => 'Could not load the image']);
            exit(400);
        }
        return '/images/' . $_FILES[0]['name'];
    }

    private function checkAuthorisation()
    {
        $post = $this->model->getPost($this->route['post']);
        if ($_SESSION['user'] !== $post[0]['user_id']) {
            $this->view->redirect('/');
        }
    }
}