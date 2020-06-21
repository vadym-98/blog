<?php
 ini_set("display_errors", 1);
 error_reporting(E_ALL);

function debug($arr) {
    echo "<pre>" . print_r($arr, true) . "</pre>";
    exit();
}
