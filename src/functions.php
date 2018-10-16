<?php

/**
 * Подключение шаблонов
 * @param $name string -- название шаблона
 * @param $data array -- массив с данными
 *
 * @return string $result -- подключаемый шаблон
 */
function include_template($name, $data) {
    $name = TEMPLATE_PATH . $name . TEMPLATE_EXTENSION;
    $result = '';

    if (!file_exists($name)) {
        return $result;
    }

    ob_start();
    extract($data, EXTR_PREFIX_INVALID, 'prefix');
    require_once $name;

    $result = ob_get_clean();
    return $result;
}


/**
 * Высчитывает количество задач в проекте
 *
 * @param array $array_tasks -- список задач
 * @param int $project_id -- id проекта
 *
 * @return int $task_count -- количество задач
 */
function get_count_tasks($array_tasks, $project_id) {
    $task_count = 0;
    foreach ($array_tasks as $task) {
        (intval($task['project_id']) === $project_id) ? $task_count++ : $task_count ;
    }
    return $task_count;
}

/**
 * Выделение задачи с истекающим/истекшим дедлайном
 * @param $task -- задача
 *
 * @return bool -- выделить ? да : нет
 */
function mark_task_important ($task) {
    if (!isset($task['deadline'])) {
        return false;
    }

    $current_time = time();
    $deadline = strtotime($task['deadline']);
    $days_until_deadline = floor(($deadline - $current_time) / SECS_IN_DAY);

    return ($days_until_deadline === 0 || (!$task['status'] && $days_until_deadline < 0));
}

/**
 * Проверка наличия пользователя по email
 * @param string $date -- установка соединения
 *
 * @return array|null -- массив с пользовательскими данными|null
 */
function set_date_format($date) {
    $date = date_create($date);
    return date_format($date, 'd.m.Y');
}

/**
 * Проверка наличия пользователя по email
 * @param string $date -- установка соединения
 *
 * @return array|null -- массив с пользовательскими данными|null
 */
function check_date($date, $format= 'Y-m-d'){
    return $date === date($format, strtotime($date));
}

/**
 * Формирование ссылки для выбранного фильтра
 * @param string $filter_item -- выбранный фильтр
 *
 * @return string -- полученная ссылка
 */
function set_filter($filter_item) {
    $data["tasks-switch"] = $filter_item;
    $path = pathinfo("index.php", PATHINFO_BASENAME);
    $query = http_build_query($data);
    $url = "/" . $path . "?" . $query;
    return $url;
}

/**
 * Вывод ошибки при выполнении запроса
 * @param mysqli $connect -- установка соединения
 *
 * @return string -- текст ошибки
 */
function show_mysql_error($connect) {
    $error = mysqli_error($connect);
    die('Ошибка при выполнении запроса к Базе данных');
};
