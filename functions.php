<?php

 function include_template($name, $data) {
    $name = TEMPLATE_PATH . $name . TEMPLATE_EXTENSION;
    $result = '';

    if (!file_exists($name)) {
        return $result;
    }

    ob_start();
    extract($data, EXTR_PREFIX_INVALID, 'prefix');
    require_once $name;

    $result = ob_get_clean();
    return $result;
}

function get_count_tasks($array_tasks, $project_name) {
    $task_count = 0;
    foreach ($array_tasks as $task) {
        if ($task['category'] === $project_name) {
            $task_count = $task_count + 1;
        }
    }
    return $task_count;
}

function markTaskImportant($task) {
    if ($task["deadline"] === null) {
        return '';
    }

    $secs_in_day = 86400;
    $current_time = time();
    $deadline = strtotime($task["deadline"]);
    $days_until_deadline = floor(($deadline - $current_time) / $secs_in_day);

    if ($days_until_deadline === 0 || (!$task['isDone'] && $days_until_deadline < 0)) {
        return "task--important";
    } else {
        return '';
    }
}
 ?>
