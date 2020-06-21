<?php


namespace app\models;


use app\core\Model;
use app\lib\DB;

class User extends Model
{
    public static function getUser($id)
    {
        return DB::getInstance()->row("select * from users where id = :id", [
            'id' => $id
        ]);
    }

    public function addUser(array $user)
    {
        $this->db->query("INSERT INTO users (username, password) VALUES (:username, :password)", [
            'username' => $user['login'],
            'password' => $user['password']
        ]);
        $this->auth($this->db->lastIndex());
    }

    public function auth($id) {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['user'] = $id;
    }

    public function isLoginUnique(string $login)
    {
        return empty($this->db->row("SELECT * FROM users WHERE username = (:username)", ['username' => $login]));
    }

    public function existUser($userData)
    {
        return $this->db->row("select id from users where username = :username and password = :password", [
            'username' => $userData['login'],
            'password' => $userData['password']
        ]);
    }
}