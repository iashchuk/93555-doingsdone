<?php

/**
 * Вывод ошибки при выполнении запроса
 * @param mysqli $connect -- установка соединения
 *
 * @return string -- текст ошибки
 */
function show_mysql_error($connect) {
    $error = mysqli_error($connect);
    die('Ошибка при выполнении запроса к Базе данных');
};


/**
 * Функция помощник для записи данных
 * @param mysqli $connect -- установка соединения
 * @param string $query -- текст запроса
 *
 * @return bool -- результат запроса
 */
function db_insert($connect, $query) {
    $result = true;
    if ($connect === false) {
        print('Ошибка подключения к базе данных: ' . mysqli_connect_error());
        $result = false;
    }
    else {
        $mysqli = mysqli_query($connect, $query);

        if (!$mysqli) {
            show_mysql_error($connect);
            $result = false;
        }
    }
    return $result;
};


/**
 * Функция помощник для получения данных
 * @param mysqli $connect -- установка соединения
 * @param string $query -- текст запроса
 *
 * @return array|bool -- результат запроса
 */
 function db_select($connect, $query) {
    $result = null;
    if ($connect === false) {
        print('Ошибка подключения к базе данных: ' . mysqli_connect_error());
    }
    else {
        $mysqli = mysqli_query($connect, $query);

        if ($mysqli) {
            $result = mysqli_fetch_all($mysqli, MYSQLI_ASSOC);
        }
        else {
            show_mysql_error($connect);
        }
    }
    return $result;
};
