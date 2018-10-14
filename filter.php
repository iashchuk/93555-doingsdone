<?php
require_once ('./root/config.php');
require_once ('./root/constants.php');
require_once ('./root/functions.php');
require_once ('./root/db_connect.php');
require_once ('./root/db_queries.php');
require_once ('./root/db_data.php');

$filter = $_GET["tasks-switch"] ?? "";


if (isset($_GET["tasks-switch"])) {

    $filter = $_GET["tasks-switch"] ?? "";

    if ($filter === "today") {
        $date = "AND deadline = CURDATE()";
        $sql = date_filter($date, $user_id);
    }

    if ($filter === "tomorrow") {
        $date = "AND deadline = CURDATE() + 1";
        $sql = date_filter($date, $user_id);
    }

    if ($filter === "delay") {
        $date = "AND deadline <= CURDATE() + 1";
        $sql = date_filter($date, $user_id);
      }

    if ($filter === "all") {
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


$page_content = include_template('index',
    [
    'show_complete_tasks' => $show_complete_tasks,
    'tasks' => $tasks,
    'filter' => $filter
    ]
);
