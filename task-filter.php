<?php

require_once ('./src/functions.php');
require_once ('./src/mysql_helper.php');


$task_filter = $_GET["tasks-switch"] ?? "";

if (isset($_GET["tasks-switch"])) {

    $task_filter = $_GET["tasks-switch"] ?? "";

    if ($task_filter === "today") {
        $date = " AND deadline = CURDATE()";
        $tasks_result = date_filter($connect, $date, $user_id);
    }

    if ($task_filter === "tomorrow") {
        $date = " AND deadline = CURDATE() + 1";
        $tasks_result = date_filter($connect, $date, $user_id);
    }

    if ($task_filter === "delay") {
        $date = " AND deadline < CURDATE() + 1";
        $tasks_result = date_filter($connect, $date, $user_id);
      }

    if ($task_filter === "all") {
        $date = "";
        $tasks_result = date_filter($connect, $date, $user_id);
    }

    $tasks = mysqli_fetch_all($tasks_result, MYSQLI_ASSOC);

}
