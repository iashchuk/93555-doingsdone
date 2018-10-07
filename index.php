<?php

require_once ('./root/config.php');
require_once ('./root/constants.php');
require_once ('./root/functions.php');
require_once ('./root/db_connect.php');
require_once ('./root/db_queries.php');


$sql_projects = get_projects_query();
$projects = DB_SELECT($connect, $sql_projects);

$sql_tasks = get_tasks_query();
$tasks = DB_SELECT($connect, $sql_tasks);
$active_tasks = $tasks;


if (isset($_GET['id'])) {

    $select_project = $_GET['id'];

    $sql_active_project = get_select_project_query($select_project);
    $result = DB_SELECT($connect, $sql_active_project);

    if ($result) {
        $sql_active_tasks = get_active_tasks_query($select_project);
        $tasks = DB_SELECT($connect, $sql_active_tasks);
    }
    else  {
     // header("HTTP/1.1 404 Not Found");
        http_response_code(404);
    }
}

else {
    $tasks = $active_tasks;
}


$page_content = include_template (
    'index',
    [
        'show_complete_tasks' => $show_complete_tasks,
        'tasks' => $tasks
    ]
);

$layout_content = include_template (
    'layout',
    [
        'tasks' => $tasks,
        'active_tasks' => $active_tasks,
        'projects' => $projects,
        'page_content' => $page_content,
        'title' => 'Дела в порядке',
        'user_name' => 'Константин'
    ]
);

print ($layout_content);
