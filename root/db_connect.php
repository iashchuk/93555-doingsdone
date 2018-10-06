<?php

$connect = mysqli_connect ($db['host'], $db['user'], $db['password'], $db['database']);
mysqli_set_charset($connect, "utf8");

if (!$connect) {
    $error = mysqli_connect_error();
    die("Ошибка подключения к базе данных");
}
