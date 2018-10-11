<?php

require_once ('./root/mysql_helper.php');

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

 function check_email($connect, $register) {
    $email = mysqli_real_escape_string($connect, $register['email']);
    $sql = "SELECT id FROM users WHERE email = '$email'";
    $result = mysqli_query($connect, $sql);
    return $result;
 }
