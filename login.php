<?php
require_once 'config.php';
require_once 'db.php';
require_once 'functions.php';

$errors = [];
if (!empty($_POST)) {
    if (empty($_POST['email'])) {
        $errors['email'] = 'Почта обязательна для заполнения';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'E-mail адрес ' . $_POST['email'] . ' указан неверно';
    }

    if (empty($_POST['password'])) {
        $errors['password'] = 'Пароль не заполнен';
    }

    if (empty($errors)) {
        $user = fetch_all($link, '
            SELECT `id`, `email`, `password`, `name`
            FROM `users`
            WHERE `email` = "' . $_POST['email'] . '";'
        );

        if (!password_verify($_POST['password'], $user[0]['password'])) {
            $errors['password'] = 'Пароль не правильный';
        }

        $_SESSION['user'] = $user[0];
        header('Location: index.php');
    }
}

$main = renderTemplate('guest.php', [
    'title' => 'Вход',
]);

$modal = renderTemplate('auth.php', [
    'errors' => $errors
]);

$content = renderTemplate('layout.php', [
    'title' => 'Список задач',
    'modal' => $modal,
    'is_auth' => $is_auth,
    'main' => $main
]);

print($content);
