<?php


namespace app\controllers;


use app\core\Controller;

class CommentController extends Controller
{
    public function storeAction()
    {
        $this->model->addComment($this->validate($_POST));
    }

    private function validate($data)
    {
        $commentData['content'] = filter_var(trim($data['content']), FILTER_SANITIZE_STRING);
        $commentData['post_id'] = $data['post_id'];
        if ($commentData['content'] === '') {
            echo json_encode(['error' => 'no empty fields']);
            exit(400);
        }
        return $commentData;
    }
}