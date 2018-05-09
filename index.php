<?php
require_once 'functions.php';
require_once 'userdata.php';

$main = renderTemplate('index.php', [
    'show_complete_tasks' => $show_complete_tasks,
    'tasks' => $tasks
]);

$content = renderTemplate('layout.php', [
    'title' => ' Список задач',
    'tasks' => $tasks,
    'categories' => $categories,
    'main' => $main
]);

print($content);

