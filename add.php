<?php

require_once  __DIR__ . '/data.php';
require_once __DIR__ . '/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

   $lot = $_POST;

    // Проверка на обязательные поля
    $required_fields = ['name', 'category', 'description', 'price', 'step', 'date'];
    $errors = [];

    foreach ($required_fields as $key) {

        // Проверка на незаполненные поля
        if (empty($lot[$key])) {
            $errors[$key] = 'Это поле нужно заполнить';
        }
    }

    // Валидация цены и шага ставки (можно вводить только цифры)
    if (!filter_var($lot['price'], FILTER_VALIDATE_INT)) {
        $errors['price'] = 'Стартовая цена должна быть корректной';
    }
    if (!filter_var($lot['step'], FILTER_VALIDATE_INT)) {
        $errors['step'] = 'Шаг ставки должен быть корректным';
    }

    // Проверка загружен ли файл
    if (isset($_FILES['url']['name'])) {
        $tmp_name = $_FILES['url']['tmp_name'];
        $path = $_FILES['url']['name'];
        $file_size = $_FILES['url']['size'];

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $tmp_name);

        // Проверка на тип загружаемого файла и его перемещение
        if ($file_type !== "image/png" && $file_type !== "image/jpg" && $file_type !== "image/jpeg") {
            $errors['url'] = 'Загрузите картинку в формате jpg, jpeg или png';
        } elseif ($file_size > 300000) {

            $errors['url'] = 'Максимальный размер картинки: 300Кб';
        } else {
            move_uploaded_file($tmp_name, 'img/' . $path);
            if (isset($path)) {
                $lot['url'] = 'img/' . $path;
            }
        }
    } else {
        $errors['url'] = 'Вы не загрузили файл';
    }

    // Проверка на наличие ошибок и вывод соответствующего шаблона
    if (count($errors)) {
        $content = render_template('add-lot', ['lot' => $lot, 'errors' => $errors, 'categories' => $categories]);
    } else {
        $content = render_template('lot', ['lot' => $lot]);
    }

} else {
    $content = render_template('add-lot', ['categories' => $categories]);
}

$layout = render_template('layout', [
    'title' => 'Добавление лота',
    'content' => $content,
    'is_auth' => $is_auth,
    'user_avatar' => $user_avatar,
    'user_name' => $user_name,
    'categories' => $categories
]);

print $layout;

