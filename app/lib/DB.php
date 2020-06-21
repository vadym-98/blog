<?php

namespace app\lib;

use app\core\View;
use PDO;

class DB {

    protected $pdo;
    protected static $db;
    protected static $exist = false;

    private function __construct() {
        $config = require "../app/config/db.php";
        $this->pdo = new PDO("mysql:host={$config['host']};dbname={$config['dbname']}", $config["user"], $config["password"]);
        $this->pdo->query("SET NAMES utf8");
        self::$exist = true;
    }

    public static function getInstance() {
        if (!self::$exist) {
            self::$db = new DB();
        }
        return self::$db;
    }

    public function query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $k => $v) {
                $stmt->bindValue(":" . $k, $v);
            }
        }
        $stmt -> execute($params);
        return $stmt;
    }

    public function row($sql, $params = []) {
        $result = $this->query($sql, $params);
        return $result->fetchAll(2);
    }

    public function lastIndex() {
        return $this->pdo->lastInsertId();
    }
}
