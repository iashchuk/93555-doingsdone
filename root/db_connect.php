<?php

$connect = mysqli_connect ($db['host'], $db['user'], $db['password'], $db['database']);
mysqli_set_charset($connect, "utf8");

if (!$connect) {
    $error = mysqli_connect_error();
    die("Ошибка подключения к базе данных");
}


function DB_INSERT($connect, $query) {
    $result = true;
    if ($connect == false) {
        print("Ошибка подключения к базе данных: " . mysqli_connect_error());
        $result = false;
    }
    else {
        mysqli_set_charset($connect, "utf8");
        $mysqli = mysqli_query($connect, $query);

        if (!$mysqli) {
            $error = mysqli_error($connect);
            print("Ошибка при выполнении запроса к Базе данных: " . $error);
            $result = false;
        }
    }
    return $result;
};

 function DB_SELECT($connect, $query) {
    $result = null;
    if ($connect == false) {
        print("Ошибка подключения к базе данных: " . mysqli_connect_error());
    }
    else {
        mysqli_set_charset($connect, "utf8");
        $mysqli = mysqli_query($connect, $query);

        if ($mysqli) {
            $result = mysqli_fetch_all($mysqli, MYSQLI_ASSOC);
        }
        else {
            $error = mysqli_error($connect);
            print("Ошибка при выполнении запроса к Базе данных: " . $error);
        }
    }
    return $result;
};
