<?php

session_start();

$connect = mysqli_connect ($db['host'], $db['user'], $db['password'], $db['database']);
mysqli_set_charset($connect, 'utf8');
$container_with_sidebar = "container--with-sidebar";

if (!$connect) {
    $error = mysqli_connect_error();
    die('Ошибка подключения к базе данных');
}

$show_complete_tasks = 0;
$user_id = 0;


if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user']['id'];
    $auth_author = $_SESSION['user']['name'];
}
