<?php
require_once ('./src/db_utils.php');

$sql_projects = get_user_project_query($user_id);
$projects = db_select($connect, $sql_projects);

$sql_tasks = get_user_tasks_query($user_id);
$tasks = db_select($connect, $sql_tasks);
$active_tasks = $tasks;


if (isset($_GET['id'])) {
    $select_project = $_GET['id'];

    $sql_active_project = get_select_project_query($select_project);
    $result = db_select($connect, $sql_active_project);

    if ($result) {
        $sql_active_tasks = get_active_tasks_query($select_project);
        $tasks = db_select($connect, $sql_active_tasks);
    }
    else  {
        http_response_code(404);
    }
}

