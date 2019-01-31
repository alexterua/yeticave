<?php

require_once  __DIR__ . '/data.php';
require_once  __DIR__ . '/userdata.php';
require_once __DIR__ . '/functions.php';

date_default_timezone_set("Europe/Kiev");

session_start();

$content = render_template('index', [
    'lots' => $lots
]);
$layout = render_template('layout', [
    'title' => 'Главная',
    'username' => $_SESSION['user']['name'],
    'content' => $content,
    'is_auth' => $is_auth,
    'user_avatar' => $user_avatar,
    'user_name' => $user_name,
    'categories' => $categories
]);

print $layout;

