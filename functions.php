<?php
 function include_template($name, $data) {
    $name = 'templates/' . $name;
    $result = '';
     if (!file_exists($name)) {
        return $result;
    }
    ob_start();
    extract($data);
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

 function esc($str) {
    $title = strip_tags($str);
    return $title;
}
 ?>
