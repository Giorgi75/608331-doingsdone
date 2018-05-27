<?php
/**
 * Вывод количества задач
 * @param array $tasks — массив со всеми задачами
 * @param string $project_id - ID проекта
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
    $current_date = time();
    if (empty($date)) {
        return false;
    }
    $task_date = strtotime($date);
    $diff_time = $task_date - $current_date;
    return ($diff_time < 24 * 60 * 60);
}

/**
 * формирование массива из базы
 * @param mysql $link соединение с базой
 * @param string $sql строка запроса
 * @return array массив данных
 */
function fetch_all($link, $sql) {
    $result = mysqli_query($link, $sql);
    if ($result) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}

/**
 * считаем количество записей в таблице
 * @param mysql $link соединение с базой
 * @param string $sql строка запроса
 * @return integer количество записей
 */
function count_db_rows($link, $sql) {
    $result = mysqli_query($link, $sql);
    if ($result) {
        return mysqli_num_rows($result);
    }
}

