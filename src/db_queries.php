<?php

require_once ('./src/mysql_helper.php');

/**
 * Получение списка проектов для текущего пользователя
 * @param mysqli $connect -- установка соединения
 * @param int $user_id -- текущий пользователь
 *
 * @return array|null -- массив задач
 */
function get_user_project_query($connect, $user_id) {
    $sql_projects = 'SELECT `id`, `title` FROM projects WHERE user_id = ?';
    $stmt = db_get_prepare_stmt($connect, $sql_projects, [$user_id]);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}


/**
 * Получение текущего проекта
 * @param mysqli $connect -- установка соединения
 * @param int $project_id -- выбранный проект
 * @param int $user_id -- текущий пользователь
 *
 * @return int -- id проекта
 */
function get_select_project_query($connect, $project_id, $user_id) {
    $sql_active_project = 'SELECT `id`, `title` FROM projects WHERE `id` = ? AND `user_id` = ?';
    $stmt = db_get_prepare_stmt($connect, $sql_active_project, [$project_id, $user_id]);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}


/**
 * Получение списка задач для текущего пользователя
 * @param mysqli $connect -- установка соединения
 * @param int $user_id -- текущий пользователь
 *
 * @return array|null -- массив задач
 */
function get_user_tasks_query($connect, $user_id) {
    $sql_tasks = 'SELECT `id`, `title`, `created`, `status`, `file`, `deadline`, `user_id`, `project_id` FROM tasks WHERE `user_id` = ?';
    $stmt = db_get_prepare_stmt($connect, $sql_tasks, [$user_id]);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}


/**
 * Получение списка задач для текущего проекта
 * @param mysqli $connect -- установка соединения
 * @param int $project_id -- выбранный проект
 * @param int $user_id -- текущий пользователь
 *
 * @return array|null -- массив задач
 */
function get_active_tasks_query($connect, $project_id, $user_id) {
    $sql_active_tasks = 'SELECT `id`, `title`, `created`, `status`, `file`, `deadline`, `user_id`, `project_id` FROM tasks WHERE `project_id` = ? AND `user_id` = ?';
    $stmt = db_get_prepare_stmt($connect, $sql_active_tasks, [$project_id, $user_id]);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}


/**
 * Проверка наличия электронной почты в базе данных
 * @param mysqli $connect -- установка соединения
 * @param array $register -- массив с введенными данными
 *
 * @return bool|mysqli_result -- id пользователя|false
 */
 function check_email($connect, $register) {
    $email = mysqli_real_escape_string($connect, $register['email']);
    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = db_get_prepare_stmt($connect, $sql, [$email]);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}


 /**
 * Запись пользовательских данных в базу данных
 * @param mysqli $connect -- установка соединения
 * @param array $register -- массив с полученными данными о пользователе
 *
 * @return bool -- результат регистрации
 */
 function register_user($connect, $register) {
    $password = password_hash($register['password'], PASSWORD_DEFAULT);
    $sql = 'INSERT INTO users (created, email, name, password, contacts) VALUES (NOW(), ?, ?, ?, "")';
    $stmt = db_get_prepare_stmt($connect, $sql, [$register['email'], $register['name'], $password]);
    $result = mysqli_stmt_execute($stmt);
    return $result;
 }


/**
 * Проверка наличия пользователя по email
 * @param mysqli $connect -- установка соединения
 * @param array $auth -- массив с введенными данными
 *
 * @return array|null -- массив с пользовательскими данными|null
 */
 function auth_user($connect, $auth) {
    $email = mysqli_real_escape_string($connect, $auth['email']);
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = db_get_prepare_stmt($connect, $sql, [$email]);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user_data = $result ? mysqli_fetch_array($result, MYSQLI_ASSOC) : null;
    return $user_data;
}


/**
 * Запись в базу данных новой задачи
 * @param array $new_task -- массив с данными задачи
 * @param mysqli $connect -- установка соединения
 * @param string $date -- дата создания задачи
 * @param string $file -- прикрепленный файл
 * @param int $user_id -- текущий пользователь
 *
 * @return bool -- возвращает ответ об успехе или неудаче
 */
function add_task($new_task, $connect, $date, $file, $user_id) {
    $sql = 'INSERT INTO tasks (created, title, deadline, file, project_id, user_id) VALUES (NOW(), ?, ?, ?, ?, ?)';
    $stmt = db_get_prepare_stmt($connect, $sql, [$new_task['name'], $date, $file, $new_task['project'], $user_id]);
    $result = mysqli_stmt_execute($stmt);
    return $result;
}


/**
 * Запись в базу данных нового проекта
 * @param array $new_project -- массив с данными проекта
 * @param mysqli $connect -- установка соединения
 * @param int $user_id -- текущий пользователь
 *
 * @return bool -- результат добавления проекта
 */
function add_project($new_project, $connect, $user_id) {
    $sql = 'INSERT INTO projects (title, user_id) VALUES (?, ?)';
    $stmt = db_get_prepare_stmt($connect, $sql, [$new_project, $user_id]);
    $result = mysqli_stmt_execute($stmt);
    return $result;
}


/**
 * Получение запроса в базу данных для фильтра задач по времени
 * @param string $date -- период фильтрации
 * @param int $user_id -- текущий пользователь
 *
 * @return string -- sql запрос
 */
function date_filter($date, $user_id) {
    intval($user_id);
    $sql = "SELECT *, date_format(deadline, '%d.%m.%Y') AS deadline
            FROM tasks WHERE user_id = $user_id $date";
    return $sql;
}


/**
 * Изменение статуса задачи
 * @param mysqli $connect -- установка соединения
 * @param int $task_id -- id задачи
 * @param int $user_id -- текущий пользователь
 *
 * @return bool|mysqli_result -- статус задачи
 */
function change_status($connect, $task_id, $user_id) {
    intval($user_id);
    intval($task_id);
    $sql = 'UPDATE tasks SET status = NOT status
            WHERE user_id = $user_id AND id = $task_id';
    $result = mysqli_query($connect, $sql);
    return $result;
}


/**
 * Выполнение полнотекстового поиска
 * @param mysqli $connect -- установка соединения
 * @param string $search -- введенное пользователем слово
 * @param int $user_id -- текущий пользователь
 *
 * @return bool|mysqli_result -- результат поиска
 */
function search_tasks($connect, $search, $user_id) {
    intval($user_id);
    $sql = 'SELECT * FROM tasks
            WHERE user_id = '.$user_id.' AND MATCH (title) AGAINST (?)';
    $stmt = db_get_prepare_stmt($connect, $sql, [$search]);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}


/**
 * Выполнение запроса о предстоящих задачах
 * @param mysqli $connect -- установка соединения
 *
 * @return bool|mysqli_result -- предстоящие задачи
 */
function get_expire_tasks($connect) {
    $sql = 'SELECT * FROM tasks
            JOIN users ON tasks.user_id = users.id
            WHERE status = 0
            AND deadline >= CURRENT_TIMESTAMP
            AND deadline <= DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 1 HOUR);';
    $result = mysqli_query($connect, $sql);
    return $result;
}
