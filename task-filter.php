<?php

require_once ('./root/db_utils.php');
require_once ('./root/functions.php');



$task_filter = $_GET["tasks-switch"] ?? "";

if (isset($_GET["tasks-switch"])) {

    $task_filter = $_GET["tasks-switch"] ?? "";

    if ($task_filter === "today") {
        $date = "AND deadline = CURDATE()";
        $sql_tasks = date_filter($date, $user_id);
    }

    if ($task_filter === "tomorrow") {
        $date = "AND deadline = CURDATE() + 1";
        $sql_tasks = date_filter($date, $user_id);
    }

    if ($task_filter === "delay") {
        $date = "AND deadline < CURDATE() + 1";
        $sql_tasks = date_filter($date, $user_id);
      }

    if ($task_filter === "all") {
        $date = "";
        $sql_tasks = date_filter($date, $user_id);
    }

    $tasks = db_select($connect, $sql_tasks);

}
