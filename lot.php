<?php

require_once  __DIR__ . '/data.php';
require_once __DIR__ . '/functions.php';

session_start();

$lot = null;

if (isset($_GET['id'])) {

    $id = --$_GET['id'];

    foreach ($lots as $key => $item) {
        if ($key == $id) {
            $lot = $item;
            break;
        }
    }

    // Установка COOKIE
    $viewed_lots = [];
    if (isset($_COOKIE['viewed_lots'])) {
        $viewed_lots = json_decode($_COOKIE['viewed_lots']);
        // Проверка на повторяющиеся элементы
        foreach ($viewed_lots as $index) {
            if ($index != $id) {
                $viewed_lots[] = $id;
            }
        }
        $viewed_lots = array_unique($viewed_lots);
    } else {
        $viewed_lots[] = $id;
    }

    setcookie('viewed_lots', json_encode($viewed_lots), strtotime("+30 days"));
}

if (!$lot) {
    http_response_code('404');
    header("Location: 404.php");
    die;
}

$content = render_template('lot', [
    'lot' => $lot
]);
$layout = render_template('layout', [
    'title' => $lot['name'],
    'username' => $_SESSION['user']['name'],
    'content' => $content,
    'is_auth' => $is_auth,
    'user_avatar' => $user_avatar,
    'user_name' => $user_name,
    'categories' => $categories
]);

print $layout;