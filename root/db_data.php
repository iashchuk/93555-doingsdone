<?php
require_once ('./root/db_utils.php');

$sql_projects = get_projects_query();
$projects = db_select($connect, $sql_projects);

$sql_tasks = get_tasks_query();
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
     // header('HTTP/1.1 404 Not Found');
        http_response_code(404);
    }
}

else {
    $tasks = $active_tasks;
}
