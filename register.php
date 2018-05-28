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
    } else {
        $user_email = fetch_all($link, '
            SELECT `email`
            FROM `users`
            WHERE `email` = "' . $_POST['email'] . '";'
        );
        if (!empty($user_email)) {
            $errors['email'] = 'Email уже используется другим пользователем';
        }
    }
    if (empty($_POST['password'])) {
        $errors['password'] = 'Пароль не заполнен';
    }
    if (empty($_POST['name'])) {
        $errors['name'] = 'Имя не заполнено';
    }

    if (empty($errors)) {
        mysqli_query($link, 'START TRANSACTION');

        $sql = '
        INSERT INTO `users`
        SET `email` = "' . mysqli_real_escape_string($link, $_POST['email']) . '",
            `password` = "' . password_hash($_POST['password'], PASSWORD_DEFAULT) . '",
            `name` = "' . mysqli_real_escape_string($link, $_POST['name']) . '";';
        $result = mysqli_query($link, $sql);
        if ($result) {
            mysqli_query($link, 'COMMIT');
            header('Location: login.php');
        } else {
            mysqli_query($link, 'ROLLBACK');
        }
    }
}

$main = renderTemplate('register.php', [
    'errors' => $errors
]);

$content = renderTemplate('layout.php', [
    'title' => 'Регистрация',
    'main' => $main
]);

print($content);
