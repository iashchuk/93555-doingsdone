<?php
require_once ('./root/config.php');
require_once ('./root/constants.php');
require_once ('./root/functions.php');
require_once ('./root/db_connect.php');
require_once ('./root/db_queries.php');
require_once ('./root/db_data.php');


$errors = [];
$tpl_data = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $auth = $_POST['auth'];
    $required = ['email', 'password'];

    foreach ($required as $input) {
        if (empty($auth[$input])) {
            $errors[$input] = 'Обязательное поле';
        }
    }

    $res_valid = filter_var($auth['email'], FILTER_VALIDATE_EMAIL);
    if (!$res_valid) {
        $errors['invaild_email'] = 'E-mail введён некорректно';
    }

    $user = auth_user($connect,  $auth);

    if (empty($errors) and $user) {
        if (password_verify($auth['password'], $user['password'])) {
            $_SESSION['user'] = $user;
        } else {
            $errors['password'] = 'Неверный пароль';
        }
    } else {
        $errors['email'] = 'Такой пользователь не существует';
    }

    if (!empty($errors)) {
        $tpl_data['errors'] = $errors;
        $tpl_data['values'] = $auth;
    } else {
        header('Location: ../index.php');
        exit();
    }

} else {
    if (isset($_SESSION['user'])) {
        $page_content = include_template(
            'index',
            [
                'tasks' => $tasks,
                'show_complete_tasks' => $show_complete_tasks
            ]
        );
    }
    // Нужен ли else, вроде и так все ОК
}


$container_with_sidebar = 'container--with-sidebar';

$content_side = include_template(
    'content-side',
    [
        'projects' => $projects,
    ]
);

$page_content = include_template(
    'auth',
     $tpl_data
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
