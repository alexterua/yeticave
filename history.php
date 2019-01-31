<?php

require_once  __DIR__ . '/data.php';
require_once __DIR__ . '/functions.php';

session_start();

$history = [];

if (isset($_COOKIE['viewed_lots'])) {
    $history = json_decode($_COOKIE['viewed_lots']);
}

$content = render_template('history', ['history' => $history, 'categories' => $categories, 'lots' => $lots]);

$layout = render_template('layout', [
    'title' => 'История просмотров',
    'username' => $_SESSION['user']['name'],
    'content' => $content,
    'is_auth' => $is_auth,
    'user_avatar' => $user_avatar,
    'user_name' => $user_name,
    'categories' => $categories
]);

print $layout;