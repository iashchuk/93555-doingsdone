<?php

require_once ('./root/config.php');
require_once ('./root/constants.php');
require_once ('./root/functions.php');
require_once ('./root/db_connect.php');


$sql_projects = "SELECT * FROM projects";
$result = mysqli_query($connect, $sql_projects);

if($result) {
    $projects = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $error = mysqli_error($connect);
    print ("Ошибка MySQL" . $error);
}


$sql_tasks = "SELECT * FROM tasks";
$result = mysqli_query($connect, $sql_tasks);

if($result) {
    $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $error = mysqli_error($connect);
    print ("Ошибка MySQL" . $error);
}


$active_tasks = $tasks;

if (isset($_GET['id'])) {

  $select_project = $_GET['id'];

  $sql_active_project = "SELECT * FROM projects WHERE id = $select_project";
  $result = mysqli_query($connect, $sql_active_project);

  if ($result) {
    $sql_active_tasks = "SELECT * FROM tasks WHERE project_id = $select_project";
    $tasks = mysqli_query($connect, $sql_active_tasks);
   } else  {
     // header("HTTP/1.1 404 Not Found");
        http_response_code(404);
   }
} else {
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
