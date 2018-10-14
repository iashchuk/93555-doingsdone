<?php
require_once ('./root/config.php');
require_once ('./root/constants.php');
require_once ('./root/functions.php');
require_once ('./root/db_connect.php');
require_once ('./root/db_queries.php');
require_once ('./root/db_data.php');

$value = [];
$errors = [];

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_project = $_POST['project'];
    $new_project_title = $new_project['title'];

     if (empty($new_project_title)) {
        $errors['empty_project'] = 'Укажите название проекта';
    } elseif (in_array($new_project_title, array_column($projects, 'title'))) {
        $errors['exist_project']  = 'Такой проект уже существует';
    }

    if (empty($errors)) {
        $value['title'] = $new_project['title'];
    }

    if (!count($errors) && isset($_SESSION['user'])) {

        $result = add_project($new_project_title, $connect, $user_id);

        if ($result) {
            header('Location: /');
            exit();
        }
        else {
            $errors['sql'] = mysqli_error($connect);
        }
    }
}


$page_content = include_template('add-project', [
    'value' => $value,
    'errors' => $errors
]);

$content_side = include_template(
    'content-side',
    [
        'projects' => $projects,
        'tasks' => $tasks,
        'active_tasks' => $active_tasks,
    ]
);

$layout_content = include_template(
    'layout',
    [
        'body_background' => '',
        'container_with_sidebar' => $container_with_sidebar,
        'content_side' => $content_side,
        'page_content' => $page_content,
        'tasks' => $tasks,
        'active_tasks' => $active_tasks,
        'projects' => $projects,
        'title' => 'Дела в порядке'
    ]
);
 print($layout_content);
