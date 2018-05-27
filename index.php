<?php
require_once 'functions.php';
require_once 'mysql_helper.php';

$show_complete_tasks = true;

$link = mysqli_connect("localhost", "root", "12345678", "todo");
mysqli_set_charset($link, "utf8");

if ($_GET['project_id']) {
    $current_project = $_GET['project_id'];
    $sql = 'SELECT date_created, date_completed, name, file, task_deadline, project_id FROM tasks WHERE project_id = ' . $current_project;
} else {
    $sql = 'SELECT date_created, date_completed, name, file, task_deadline, project_id FROM tasks';
}


$result = mysqli_query($link, $sql);
if ($result) {
    $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);

}

$sql = 'SELECT id, name, alias FROM projects WHERE user_id = 1';
$result = mysqli_query($link, $sql);
if ($result) {
    $projects = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

$main = renderTemplate('index.php', [
    'show_complete_tasks' => $show_complete_tasks,
    'tasks' => $tasks
]);

$content = renderTemplate('layout.php', [
    'title' => ' Список задач',
    'tasks' => $tasks,
    'projects' => $projects,
    'main' => $main
]);

print($content);
