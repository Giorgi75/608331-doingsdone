<?php
/**
 * Вывод количества задач
 * @param array $tasks — массив со всеми задачами
 * @param string $project_id - ключ категории
 * @return integer — количество задач
 */
function count_tasks($tasks, $project_id = NULL) {
    if ($project_id) {
        $counter = 0;
        foreach ($tasks as $task) {
            if ($task['project_id'] === $project_id) {
                $counter++;
            }
        }
        return $counter;
    } else {
        return count($tasks);
    }
}
/**
 * функция генерации шаблона
 * @param string $template_name название шаблона
 * @param array $template_data данные для шаблона
 * @return string возвращаем сгенерированный html
 */
function renderTemplate($template_name, $template_data) {
    $file_name = 'templates/' . $template_name;
    if (is_readable($file_name)) {
        ob_start();
        extract($template_data);
        require $file_name;
        return ob_get_clean();
    } else {
        return '';
    }
}

/**
 * проверяем просрочена ли задача
 * @param datetime $date  дата и время задачи
 * @return boolean просрочена ли задача
 */
function is_task_deadline($date) {
    if ($date === 'Нет') {
        return false;
    }
    $current_date = time();
    $task_date = strtotime($date);
    $diff_time = $task_date - $current_date;
    print($diff_time);
    return ($diff_time < 24 * 60 * 60);
}






