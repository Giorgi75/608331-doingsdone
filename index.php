<?php

require_once 'config.php';
require_once 'db.php';
require_once 'functions.php';
require_once 'mysql_helper.php';

$current_user = 1;

$errors = [];
if (!empty($_POST)) {
    if (empty($_POST['name'])) {
        $errors['name'] = 'Введите название задачи';
    }
    if (empty($_POST['project'])) {
        $errors['project'] = 'Выберите проект';
    }
    if (empty($errors)) {
        mysqli_query($link, 'START TRANSACTION');

        if (!empty($_POST['date'])) {
            $task_deadline = '"' . mysqli_real_escape_string($link, $_POST['date']) . '"';
        } else {
            $task_deadline = 'NULL';
        }
        $sql = '
        INSERT INTO `tasks`
        SET `name` = "' . mysqli_real_escape_string($link, $_POST['name']) . '",
            `task_deadline` = ' . $task_deadline . ',
            `user_id` = ' . $current_user . ',
            `project_id` = ' . intval($_POST['project']) . ';';
        $result = mysqli_query($link, $sql);
        print($sql);
        if ($result) {
            mysqli_query($link, 'COMMIT');
            header("Location: index.php?project_id=" . intval($_POST['project']));
        } else {
            mysqli_query($link, 'ROLLBACK');
        }
    }
}

$show_complete_tasks = (isset($_GET['show_completed'])) ? $_GET['show_completed'] : false;

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

$modal_task = renderTemplate('task.php', [
    'errors' => $errors,
    'projects' => $projects
]);

$content = renderTemplate('layout.php', [
    'title' => ' Список задач',
    'all_tasks' => $all_tasks,
    'user_tasks' => $tasks,
    'projects' => $projects,
    'errors' => $errors,
    'modal_task' => $modal_task,
    'main' => $main
]);

print($content);
