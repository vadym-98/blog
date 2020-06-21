<?php

use app\core\Router;
use app\lib\DB;

require "../app/lib/Dev.php";
require '../app/migrations/migrations.php';

spl_autoload_register(function ($class) {
    $path = str_replace("\\", "/", '../'. $class . ".php");
    if (is_file($path)) {
        require_once $path;
    }
});
session_start();

$router = new Router();
$router->run();