<?php

require_once ('./root/config.php');
require_once ('./root/constants.php');
require_once ('./root/functions.php');
require_once ('./root/db_connect.php');
// require_once ('./db/data.php');

$connect = mysqli_connect ($db['host'], $db['user'], $db['password'], $db['database']);
mysqli_set_charset($connect, "utf8");

if (!$connect) {
    $error = mysqli_connect_error();
    $content = include_template('error.php', ['error' => error]);
    print("Ошибка подключения к базе данных " . $error);
} else {
    print("Соединение установлено");
}


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
        'projects' => $projects,
        'page_content' => $page_content,
        'title' => 'Дела в порядке',
        'user_name' => 'Константин'
    ]
);

print ($layout_content);

?>
