<?php

require_once __DIR__ . '/init.php';
require_once  __DIR__ . '/data.php';
require_once  __DIR__ . '/userdata.php';
require_once __DIR__ . '/functions.php';

session_start();

if (!$link) {
    $error = mysqli_connect_error();
    $content = render_template('errors/error', ['error' => $error]);
} else {
    $sql = 'SELECT * FROM categories';
    $result = mysqli_query($link, $sql);
    if ($result) {
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        $error = mysqli_error($link);
        $content = render_template('error', ['error' => $error]);
    }
}

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

