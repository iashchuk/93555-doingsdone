<?php

require_once ('./root/functions.php');


$task_filter = $_GET["tasks-switch"] ?? "";

if (isset($_GET["tasks-switch"])) {

    $task_filter = $_GET["tasks-switch"] ?? "";

    if ($task_filter === "today") {
        $date = "AND deadline = CURDATE()";
        $sql = date_filter($date, $user_id);
    }

    if ($task_filter === "tomorrow") {
        $date = "AND deadline = CURDATE() + 1";
        $sql = date_filter($date, $user_id);
    }

    if ($task_filter === "delay") {
        $date = "AND deadline < CURDATE() + 1";
        $sql = date_filter($date, $user_id);
      }

    if ($task_filter === "all") {
        $date = "";
        $sql = date_filter($date, $user_id);
    }

    $result = mysqli_query($connect, $sql);

    if (!$result) {
        $error = mysqli_error($connect);
        die('Ошибка при выполнении запроса к Базе данных');
    } else {
        $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
