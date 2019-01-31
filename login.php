<?php

require_once  __DIR__ . '/data.php';
require_once  __DIR__ . '/userdata.php';
require_once __DIR__ . '/functions.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $form = $_POST;

    // Проверка на обязательные поля
    $required_fields = ['email', 'password'];
    $errors = [];

    foreach ($required_fields as $field) {
        if (empty($form[$field])) {
            $errors[$field] = 'Это поле нужно заполнить';
        }
    }

    // Проверка на корректность email
    if (!filter_var($form['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Введите корректный email';
    }

    // Проверка на корректность password
    if (!count($errors) && $user = searchUserByEmail($form['email'], $users)) {
        if (password_verify($form['password'], $user['password'])) {
            $_SESSION['user'] = $user;
        } else {
            $errors['password'] = 'Вы ввели неверный пароль';
        }
    } else {
        $errors['email'] = 'Пользователь с таким email не найден';
    }

    if (count($errors)) {
        $content = render_template('login', ['form' => $form, 'errors' => $errors, 'categories' => $categories]);
    } else {
        header("Location: /");
        die;
    }

} else {
    if (isset($_SESSION['user'])) {
        $content = render_template('index', ['lots' => $lots, 'categories' => $categories]);
    } else {
        $content = render_template('login', ['categories' => $categories]);
    }

}

$layout = render_template('layout', [
    'title' => 'Страница входа',
    'content' => $content,
    'username' => $_SESSION['user']['name'],
    'is_auth' => $is_auth,
    'user_avatar' => $user_avatar,
    'user_name' => $user_name,
    'categories' => $categories
]);

print $layout;

