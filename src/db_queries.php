<?php

require_once ('./src/mysql_helper.php');

function get_projects_query() {
    $sql_projects = "SELECT `id`, `title` FROM projects";
    return $sql_projects;
}

function get_user_project_query($user_id) {
    intval($user_id);
    $sql_projects = "SELECT `id`, `title` FROM projects WHERE `user_id` = $user_id";
    return $sql_projects;
}

function get_select_project_query($project_id) {
    intval($project_id);
    $sql_active_project = "SELECT `id`, `title` FROM projects WHERE `id` = $project_id";
    return $sql_active_project;
}

function get_tasks_query() {
    $sql_tasks = "SELECT `id`, `title`, `created`, `status`, `file` `deadline`, `user_id`, `project_id` FROM tasks";
    return  $sql_tasks;
}

function get_user_tasks_query($user_id) {
    intval($user_id);
    $sql_tasks = "SELECT `id`, `title`, `created`, `status`, `file`, `deadline`, `user_id`, `project_id` FROM tasks WHERE `user_id` = $user_id";
    return  $sql_tasks;
}

function get_active_tasks_query($project_id) {
    intval($project_id);
    $sql_active_tasks = "SELECT `id`, `title`, `created`, `status`, `file`, `deadline`, `user_id`, `project_id` FROM tasks WHERE project_id = $project_id";
    return $sql_active_tasks;
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

function set_filter($filter_item) {
    $data["tasks-switch"] = $filter_item;
    $path = pathinfo("index.php", PATHINFO_BASENAME);
    $query = http_build_query($data);
    $url = "/" . $path . "?" . $query;
    return $url;
}

function get_expire_tasks($connect) {
    $sql = "SELECT * FROM tasks
            JOIN users ON tasks.user_id = users.id
            WHERE status = 0
            AND deadline >= CURRENT_TIMESTAMP
            AND deadline <= DATE_ADD(CURRENT_TIMESTAMP, INTERVAL +1 HOUR);";
    $result = mysqli_query($connect, $sql);
    return $result;
}
