<?php

require_once ('./config.php');
require_once ('./src/constants.php');
require_once ('./src/functions.php');
require_once ('./src/db_connect.php');
require_once ('./src/db_queries.php');
require_once ('./src/db_data.php');


$errors = [];
$tpl_data = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $register = $_POST['signup'];
    $required = ['email', 'password', 'name'];

    foreach ($required as $input) {
        if (empty($register[$input])) {
            $errors[$input] = 'Обязательное поле';
        }
    }

    $res_check = check_email($connect, $register);
    if (mysqli_num_rows($res_check) > 0) {
        $errors['used_email'] = 'Пользователь с этим email уже зарегистрирован';
    }

    $res_valid = filter_var($register['email'], FILTER_VALIDATE_EMAIL);
     if (!$res_valid) {
        $errors['invaild_email'] = 'E-mail введён некорректно';
    }


    if (!empty($errors)) {
        $tpl_data['errors'] = $errors;
        $tpl_data['values'] = $register;
    } else {
        $new_user = register_user($connect, $register);

        if ($new_user) {
            header('Location: /auth.php');
        } else {
            show_mysql_error();
        }
    }
}


$container_with_sidebar = 'container--with-sidebar';

$content_side = include_template(
    'content-side',
    [
        'projects' => $projects,
    ]
);

$page_content = include_template(
    'register',
    $tpl_data
);

$layout_content = include_template(
    'layout',
    [
        'body_background' => '',
        'container_with_sidebar' => $container_with_sidebar,
        'content_side' => $content_side,
        'tasks' => $tasks,
        'active_tasks' => $active_tasks,
        'projects' => $projects,
        'page_content' => $page_content,
        'title' => 'Дела в порядке'
    ]
);


 print($layout_content);
