<?php


namespace app\models;


use app\core\Model;
use app\lib\DB;

class Tag extends Model
{
    public static function all()
    {
        return DB::getInstance()->row("SELECT * FROM tags");
    }

    public function getAllPosts($tag)
    {
        return $this->db->row("select posts.* from posts 
                            inner join post_tag on posts.id = post_tag.post_id
                            inner join tags on post_tag.tag_id = tags.id where tags.name = :tag", [
            'tag' => $tag
        ]);
    }
}