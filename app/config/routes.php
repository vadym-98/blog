<?php

return [
    "" => [
        "controller" => "post",
        "action" => "index"
    ],
    "post/delete/{post:\d+}" => [
        "controller" => "post",
        "action" => "destroy"
    ],
    "post/edit/{post:\d+}" => [
        "controller" => "post",
        "action" => "edit"
    ],
    "post/update/{post:\d+}" => [
        "controller" => "post",
        "action" => "update"
    ],
    "post/create" => [
        "controller" => "post",
        "action" => "create"
    ],
    "post/add" => [
        "controller" => "post",
        "action" => "store"
    ],
    "post/show/{post:\d+}" => [
        "controller" => "post",
        "action" => "show"
    ],
    'login' => [
        'controller' => 'user',
        'action' => 'login'
    ],
    'auth' => [
        'controller' => 'user',
        'action' => 'auth'
    ],
    'logout' => [
        'controller' => 'user',
        'action' => 'logout'
    ],
    'register' => [
        'controller' => 'user',
        'action' => 'create'
    ],
    'create-user' => [
        'controller' => 'user',
        'action' => 'store'
    ],
    'comment/create' => [
        'controller' => 'comment',
        'action' => 'store'
    ],
    'tags' => [
        'controller' => 'tag',
        'action' => 'index'
    ]
];