<?php

require_once ('./root/config.php');
require_once ('./root/constants.php');
require_once ('./root/functions.php');
require_once ('./root/db_connect.php');
require_once ('./root/db_queries.php');

$user_id = 1;

$sql_projects = get_user_project_query($user_id);
$projects = DB_SELECT($connect, $sql_projects);

$sql_tasks = get_tasks_query();
$tasks = DB_SELECT($connect, $sql_tasks);

$active_tasks = $tasks;
$new_task["name"] = "";
$errors = [];


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $new_task = $_POST;
    $errors = [];

    if (empty($new_task['name'])) {
        $errors['name'] = 'Укажите название задачи';
    }

    $isFile = false;

    if (isset($_FILES["preview"])) {
        $file_name = $_FILES["preview"]["name"];
        $file_path = __DIR__ . "/uploads/";
        $file_url = "/uploads/" . $file_name;
        $isFile = true;
    }


    if (empty($errors)) {
        $new_task_name = $new_task["name"];
        if ($isFile) {
            $new_task_file = $file_path . $file_name;
        } else {
            $new_task_file = "";
    }

        $new_task_project = $new_task["project"];
        $new_task_date = $new_task["date"];
        if ($new_task_date === "") {
            $new_task_date = null;
        };

        $insert_request = "INSERT INTO tasks SET
            created = NOW(),
            title = '$new_task_name',
            file = '$new_task_file',
            deadline =  '$new_task_date',
            user_id = '$user_id',
            project_id = '$new_task_project'
        ";

        $insert_result = DB_INSERT($connect, $insert_request);
        if ($insert_result) {
            if ($isFile) {
                move_uploaded_file($_FILES["preview"]["tmp_name"], $file_path . $file_name);
            }
            header("Location: /index.php");
        }
    }
 }

$page_content = include_template(
    "form-task",
    [
        "projects" => $projects,
        "tasks" => $tasks,
        "new_task" => $new_task,
        "errors" => $errors
    ]
);

$layout_content = include_template (
    'layout',
    [
        'tasks' => $tasks,
        'active_tasks' => $active_tasks,
        'projects' => $projects,
        'page_content' => $page_content,
        'title' => 'Добавить задачу',
        'user_name' => 'Константин'
    ]
);

 print ($layout_content);
 ?>
