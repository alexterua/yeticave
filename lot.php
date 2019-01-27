<?php

require_once  __DIR__ . '/data.php';
require_once __DIR__ . '/functions.php';

$lot = null;

if (isset($_GET['id'])) {

    $id = --$_GET['id'];

    foreach ($lots as $key => $item) {
        if ($key == $id) {
            $lot = $item;
            break;
        }
    }
}

if (!$lot) {
    http_response_code('404');
    header("Location: 404.php");
}

$content = render_template('lot', [
    'lot' => $lot
]);
$layout = render_template('layout', [
    'title' => $lot['name'],
    'content' => $content,
    'is_auth' => $is_auth,
    'user_avatar' => $user_avatar,
    'user_name' => $user_name,
    'categories' => $categories
]);

print $layout;