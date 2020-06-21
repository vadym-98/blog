<?php


namespace app\models;


use app\core\Model;
use app\lib\DB;

class Comment extends Model
{

    public static function getComments($post)
    {
        return DB::getInstance()->row("select * from comments where post_id = :post_id", [
            'post_id' => $post['id']
        ]);
    }

    public function addComment($comment)
    {
        $user = $this->db->row('select * from users where id = :id', [
            'id' => $_SESSION['user']
        ])[0];
        $this->db->query("insert into comments (content, post_id, user_mail)
                    values (:content, :post_id, :user_mail)", [
            'content' => $comment['content'],
            'post_id' => $comment['post_id'],
            'user_mail' => $user['username']
        ]);
    }
}