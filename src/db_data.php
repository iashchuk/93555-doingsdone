<?php

$result_projects = get_user_project_query($connect, $user_id);
$projects = mysqli_fetch_all($result_projects, MYSQLI_ASSOC);

$result_tasks = get_user_tasks_query($connect, $user_id);
$tasks = mysqli_fetch_all($result_tasks, MYSQLI_ASSOC);
$active_tasks = $tasks;


if (isset($_GET['id'])) {
    $select_project = $_GET['id'];

    $result_active_project = get_select_project_query($connect, $select_project, $user_id);
    $active_project = mysqli_fetch_all($result_active_project, MYSQLI_ASSOC);

    if ($active_project) {
        $result_active_tasks = get_active_tasks_query($connect, $select_project, $user_id);
        $tasks = mysqli_fetch_all($result_active_tasks, MYSQLI_ASSOC);
    }
    else  {
        http_response_code(404);
    }
}

