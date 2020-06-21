<?php


namespace app\core;

use app\core\View;

abstract class Controller {

    public $route;
    public $view;

    public function __construct($route) {
        $this->route = $route;
        $this->view = new View($route);
        $this->model = $this -> loadModel($route["controller"]);
    }

    public function loadModel($name) {
        $path = "app\models\\" . ucfirst($name);
        if (class_exists($path)) {
            return new $path;
        }
    }

//    public function checkAcl() {
//        $this->acl = require "application/acl/" . $this->route["controller"] . ".php";
//        if ($this->isAcl("all")) {
//            return true;
//        } else if (isset($_SESSION["authorize"]["id"]) and $this->isAcl("authorize")) {
//            return true;
//        } else if (!isset($_SESSION["authorize"]["id"]) and $this->isAcl("guest")) {
//            return true;
//        } else if (isset($_SESSION["admin"]) and $this->isAcl("admin")) {
//            return true;
//        }
//        return false;
//    }
//
//    public function isAcl($key) {
//        return in_array($this->route["action"], $this->acl[$key]);
//    }
}