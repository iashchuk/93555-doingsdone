<?php

require_once ('./src/functions.php');

$show_complete_tasks = 0;

if (isset($_GET['show_completed'])) {
    $show_complete_tasks = intval($_GET['show_completed']);
    $_SESSION['user']['show_completed'] = intval($_GET['show_completed']);
}
elseif (isset($_SESSION['user']['show_completed'])) {
    $show_complete_tasks = $_SESSION['user']['show_completed'];
}


if (isset($_GET['task_id'])) {
    $task_id = intval($_GET['task_id']) ?? '';
     if ($task_id) {
        $result = change_status($connect, $task_id, $user_id);
        header('Location: index.php');
    }
}
