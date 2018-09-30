<?php

require_once ('./root/config.php');
require_once ('./root/constants.php');
require_once ('./root/functions.php');
require_once ('./db/data.php');


$page_content = include_template (
    'index',
    [
        'show_complete_tasks' => $show_complete_tasks,
        'tasks' => $tasks
    ]
);

$layout_content = include_template (
    'layout',
    [
        'tasks' => $tasks,
        'projects' => $projects,
        'page_content' => $page_content,
        'title' => 'Дела в порядке',
        'user_name' => 'Константин'
    ]
);

print ($layout_content);

?>
