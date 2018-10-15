<?php

require_once ('./src/mysql_helper.php');

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

function get_count_tasks($array_tasks, $project) {
    $task_count = 0;
    foreach ($array_tasks as $task) {
        ($task['project_id'] === $project) ? $task_count++ : $task_count ;
    }
    return $task_count;
}

function mark_task_important ($task) {
    if ($task['deadline'] === null) {
        return false;
    }

    $current_time = time();
    $deadline = strtotime($task['deadline']);
    $days_until_deadline = floor(($deadline - $current_time) / SECS_IN_DAY);

    return ($days_until_deadline === 0 || (!$task['status'] && $days_until_deadline < 0));
}

function set_date_format($date) {
    $date = date_create($date);
    return date_format($date, 'd.m.Y');
}

function check_date($date, $format= 'Y-m-d'){
    return $date === date($format, strtotime($date));
}

 function check_email($connect, $register) {
    $email = mysqli_real_escape_string($connect, $register['email']);
    $sql = "SELECT id FROM users WHERE email = '$email'";
    $result = mysqli_query($connect, $sql);
    return $result;
 }

 function register_user($connect, $register) {
    $password = password_hash($register['password'], PASSWORD_DEFAULT);
    $sql = 'INSERT INTO users (created, email, name, password, contacts) VALUES (NOW(), ?, ?, ?, "")';
    $stmt = db_get_prepare_stmt($connect, $sql, [$register['email'], $register['name'], $password]);
    $result = mysqli_stmt_execute($stmt);
    return $result;
 }

  function auth_user($connect, $auth) {
    $email = mysqli_real_escape_string($connect, $auth['email']);
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($connect, $sql);
    $session_array = $result ? mysqli_fetch_array($result, MYSQLI_ASSOC) : null;
    return $session_array;
}


function add_task($new_task, $connect, $date, $file, $user) {
    $sql = "INSERT INTO tasks (created, title, deadline, file, project_id, user_id) VALUES (NOW(), ?, ?, ?, ?, ?)";
    $stmt = db_get_prepare_stmt($connect, $sql, [$new_task['name'], $date, $file, $new_task['project'], $user]);
    $result = mysqli_stmt_execute($stmt);
    return $result;
}

function add_project($new_project, $connect, $user) {
    $sql = 'INSERT INTO projects (title, user_id) VALUES (?, ?)';
    $stmt = db_get_prepare_stmt($connect, $sql, [$new_project, $user]);
    $result = mysqli_stmt_execute($stmt);
    return $result;
}

function set_filter($filter_item) {
    $data["tasks-switch"] = $filter_item;
    $path = pathinfo("index.php", PATHINFO_BASENAME);
    $query = http_build_query($data);
    $url = "/" . $path . "?" . $query;
    return $url;
}

function date_filter($date, $user_id) {
    intval($user_id);
    $sql = "SELECT *, date_format(deadline, '%d.%m.%Y') AS deadline
            FROM tasks WHERE user_id = $user_id $date";
    return $sql;
}

function change_status($connect, $task_id, $user_id) {
    intval($user_id);
    intval($task_id);
    $sql = "UPDATE tasks SET status = NOT status
            WHERE user_id = $user_id AND id = $task_id";
    $result = mysqli_query($connect, $sql);
    return $result;
}

function search_tasks($connect, $search, $user_id) {
    intval($user_id);
    $sql = 'SELECT * FROM tasks
            WHERE user_id = '.$user_id.' AND MATCH (title) AGAINST (?)';
    $stmt = db_get_prepare_stmt($connect, $sql, [$search]);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}
