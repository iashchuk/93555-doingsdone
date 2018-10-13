<?php

require_once ('./root/config.php');
require_once ('./root/constants.php');
require_once ('./root/functions.php');
require_once ('./root/db_connect.php');
require_once ('./root/db_queries.php');
require_once ('./root/db_data.php');


$sql_projects = get_user_project_query($user_id);
$projects = db_select($connect, $sql_projects);

$sql_tasks = get_tasks_query();
$tasks = db_select($connect, $sql_tasks);

$active_tasks = $tasks;
$new_task['name'] = '';
$errors = [];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $new_task = $_POST;
    $errors = [];

    if (empty($new_task['name'])) {
        $errors['name'] = 'Укажите название задачи';
    }

    $file = false;

    if (isset($_FILES['preview'])) {
        $file_name = $_FILES['preview']['name'];
        $file_path = __DIR__ . '/uploads/';
        $file_url = '/uploads/' . $file_name;
        $file = true;
    }


    if (empty($errors)) {
        $new_task_name = $new_task['name'];
        if ($file) {
            $new_task_file = $file_path . $file_name;
        } else {
            $new_task_file = '';
        }

        $new_task_project = $new_task['project'];

        $new_task_date = $new_task['date'];

        if (empty($new_task_date)) {
            $new_task_date = NULL;
        } elseif (!check_date($new_task_date)) {
            $errors['date'] = 'Введите дату в формате дд.мм.гггг';
        }

        $sql = "INSERT INTO tasks  (created, title, file, deadline, user_id, project_id) VALUE (NOW(), ?, ?, ?, ?, ?)";
        $stmt = db_get_prepare_stmt($connect, $sql, [$new_task_name, $new_task_file, $new_task_date, $user_id,  $new_task_project]);
        $insert_result = mysqli_stmt_execute($stmt);


        if ($insert_result) {
            if ($file) {
                move_uploaded_file($_FILES['preview']['tmp_name'], $file_path . $file_name);
            }
            header('Location: /index.php');
        }
    }
 }


$content_side = include_template(
    'content-side', [
        'projects' => $projects,
        'tasks' => $tasks,
        'active_tasks' => $active_tasks,
    ]
);

$page_content = include_template(
    'form-task',
    [
        'projects' => $projects,
        'tasks' => $tasks,
        'new_task' => $new_task,
        'errors' => $errors
    ]
);

$layout_content = include_template (
    'layout',
    [
        'body_background' => '',
        'container_with_sidebar' => $container_with_sidebar,
        'content_side' => $content_side,
        'page_content' => $page_content,
        'projects' => $projects,
        'tasks' => $tasks,
        'active_tasks' => $active_tasks,
        'title' => 'Дела в порядке'
    ]
);

 print ($layout_content);

