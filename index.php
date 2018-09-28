<?php

require_once ('./config.php');
require_once ('./constants.php');
require_once ('./functions.php');
require_once ('./data.php');


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
