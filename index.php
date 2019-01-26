<?php

require_once  __DIR__ . '/data.php';
require_once __DIR__ . '/functions.php';

$content = render_template('index', [
    'lots' => $lots
]);
print $layout = render_template('layout', [
    'title' => 'Главная',
    'content' => $content,
    'is_auth' => $is_auth,
    'user_avatar' => $user_avatar,
    'user_name' => $user_name,
    'categories' => $categories
]);

