<?php
require_once 'config.php';
require_once 'db.php';
require_once 'functions.php';
require_once 'mysql_helper.php';

$show_complete_tasks = (isset($_GET['show_completed'])) ? $_GET['show_completed'] : false;
$current_user = 1;


$all_tasks = fetch_all($link, '
    SELECT `date_created`, `date_completed`, `name`, `file`, `task_deadline`, `project_id`
    FROM `tasks`
    WHERE `user_id` = ' . $current_user
);

if (isset($_GET['project_id'])) {
    $current_project = $_GET['project_id'];
    $tasks = fetch_all($link, '
        SELECT `date_created`, `date_completed`, `name`, `file`, `task_deadline`, `project_id`
        FROM `tasks`
        WHERE `project_id` = ' . $current_project . '
        AND `user_id` = ' . $current_user
    );
} else {
    $tasks = $all_tasks;
}

$projects = fetch_all($link, '
    SELECT `id`, `name`, `alias`
    FROM `projects`
    WHERE `user_id` = ' . $current_user
);

$main = renderTemplate('index.php', [
    'show_complete_tasks' => $show_complete_tasks,
    'tasks' => $tasks
]);

$content = renderTemplate('layout.php', [
    'title' => ' Список задач',
    'all_tasks' => $all_tasks,
    'user_tasks' => $tasks,
    'projects' => $projects,
    'main' => $main
]);

print($content);
