<?php

$config = require "../app/config/db.php";
$db = new PDO("mysql:host={$config['host']};dbname={$config['dbname']}", $config["user"], $config["password"]);
$db->query("SET NAMES utf8");

function getMigrationFiles() {
    global $db;
    $sqlFiles = glob('../app/migrations/*.sql');
    $row = $db->prepare("SHOW TABLES LIKE '%versions%'");
    $row->execute();
    $row = $row->fetchAll(2);
    if (!$row) {
        return $sqlFiles;
    }
    $fileNames = $db->query('SELECT name FROM versions');
    $fileNames = $fileNames->fetchAll(2);
    $versionsFiles = [];
    foreach ($fileNames as $row) {
        array_push($versionsFiles, '../app/migrations/' . $row['name']);
    }
    return array_diff($sqlFiles, $versionsFiles);
}

function migrate($file) {
    global $db;
    $query = sprintf('mysql -uroot -ppassword -h localhost -D blog < %s', $file);
    shell_exec($query);
    $baseName = basename($file);
    $query = sprintf('INSERT INTO `versions` (`name`) VALUES ("%s")',  $baseName);
    $db->query($query);
}

$files = getMigrationFiles();
if (!empty($files)) {
    foreach ($files as $file) {
        migrate($file);
    }

    echo '<br>Миграция завершена.';
}

