<?php


namespace app\models;


use app\core\Model;

class Post extends Model
{

    public function all()
    {
        return $this->db->row("select * from(SELECT posts.*, GROUP_CONCAT(tags.name) as tags FROM posts
                     LEFT JOIN post_tag ON post_tag.post_id = posts.id
                     LEFT JOIN tags ON tags.id = post_tag.tag_id
                     GROUP BY posts.id) as result order by created desc;");
    }

    public function getPost($post_id)
    {
        return $this->db->row("SELECT posts.*, GROUP_CONCAT(tags.name) as tags FROM posts
                  LEFT JOIN post_tag ON post_tag.post_id = posts.id
                  LEFT JOIN tags ON tags.id = post_tag.tag_id WHERE posts.id = :id GROUP BY posts.id", [
                'id' => $post_id
        ]);
    }

    public function addPost(array $post, $user_id)
    {
        $this->db->query("INSERT INTO posts (title, content, `status`, image, user_id)
                    VALUES (:title, :content, :status, :image, :user_id)", [
            'title' => $post['title'],
            'content' => $post['content'],
            'status' => $post['status'],
            'image' => $post['image'],
            'user_id' => $user_id
        ]);
        $post_id = $this->db->lastIndex();
        foreach (explode(',', $post['tags']) as $tag) {
            $this->db->query("insert into post_tag(post_id, tag_id) values (:post_id, :tag_id)", [
                'post_id' => $post_id,
                'tag_id' => $tag
            ]);
        }
    }

    public function editPost(array $post)
    {
        $this->db->query("UPDATE posts SET title = :title, content = :content, `status` = :status where id = :id", [
            'id' => $post['id'],
            'title' => $post['title'],
            'content' => $post['content'],
            'status' => $post['status'],
        ]);
        $post_id = $post['id'];
        $this->db->query("DELETE FROM post_tag WHERE post_id = :id", [
            'id' => $post_id
        ]);
        foreach (explode(',', $post['tags']) as $tag) {
            $this->db->query("insert into post_tag(post_id, tag_id) values (:post_id, :tag_id)", [
                'post_id' => $post_id,
                'tag_id' => $tag
            ]);
        }
    }

    public function isTitleUnique(string $title, $id)
    {
        $unique = $this->db->row("SELECT * FROM posts WHERE title = (:title)", ['title' => $title]);
        if ($id !== 0 && $unique[0]['id'] === $id) return true;
        return empty($unique);
    }

    public function deletePost($post_id)
    {
        $this->db->query("DELETE FROM posts WHERE id = :id", [
            'id' => $post_id
        ]);
    }

    public function readPosts()
    {
        $posts = $this->db->row("select * from posts where read_at is NULL");
        foreach ($posts as $post) {
            $this->db->query("update posts set read_at = current_timestamp where id = :id", [
                'id' => $post['id']
            ]);
        }
    }

    public function changeStatus()
    {
        $posts = $this->db->row("select * from posts where read_at is not null and status = 'new'");
        foreach ($posts as $post) {
            $this->db->query("update posts set status = 'open' where id = :id", [
                'id' => $post['id']
            ]);
        }
    }
}