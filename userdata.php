<?php

// пользователи для аутентификации
$users = [
    [
        'email' => 'ignat.v@gmail.com',
        'name' => 'Игнат',
        'password' => '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka'
    ],
    [
        'email' => 'kitty_93@li.ru',
        'name' => 'Леночка',
        'password' => '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa'
    ],
    [
        'email' => 'warrior07@mail.ru',
        'name' => 'Руслан',
        'password' => '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW'
    ]
];

// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);
$categories = [
    'incoming' => 'Входящие',
    'learning' => 'Учеба',
    'work' => 'Работа',
    'housework' => 'Домашние дела',
    'auto' => 'Авто'
];
$tasks =[
    [
        'title' => 'Собеседование в IT компании',
        'date' => '01.06.2018',
        'categories' => $categories['work'],
        'completed' => false
    ], [
        'title' => 'Выполнить тестовое задание',
        'date' => '25.05.2018',
        'categories' => $categories['work'],
        'completed' => false
    ], [
        'title' => 'Сделать задание первого раздела',
        'date' => '21.04.2018',
        'categories' => $categories['learning'],
        'completed' => true
    ], [
        'title' => 'Встреча с другом',
        'date' => '22.04.2018',
        'categories' => $categories['incoming'],
        'completed' => false
    ], [
        'title' => 'Купить корм для кота',
        'date' => 'Нет',
        'categories' => $categories['housework'],
        'completed' => false
    ], [
        'title' => 'Заказать пиццу',
        'date' => 'Нет',
        'categories' => $categories['housework'],
        'completed' => false
    ],
];
