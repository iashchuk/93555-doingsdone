<?php

require_once ('./config.php');
require_once ('./src/functions.php');
require_once ('./src/db_connect.php');
require_once ('./src/db_queries.php');
require_once ('./src/db_data.php');
require_once ('./src/db_utils.php');
require_once ('./task-filter.php');
require_once ('./task-status.php');
require_once ('./task-search.php');


$body_background = 'body-background';

if (!isset($_SESSION['user']))  {

    $page_content = include_template(
        'guest',
        []
    );

    $layout_content = include_template(
        'layout',
        [
            'tasks' => $tasks,
            'active_tasks' => $active_tasks,
            'projects' => $projects,
            'body_background' => $body_background,
            'container_with_sidebar' => '',
            'content_side' => '',
            'page_content' => $page_content,
            'title' => 'Дела в порядке'
        ]
    );
} else {

    $content_side = include_template(
        'content-side',
        [
            'projects' => $projects,
            'tasks' => $tasks,
            'active_tasks' => $active_tasks
        ]
    );

    $page_content = include_template(
        'index',
        [
            'show_complete_tasks' => $show_complete_tasks,
            'tasks' => $tasks,
            'task_filter' => $task_filter
        ]
);

    $layout_content = include_template(
        'layout',
        [
            'body_background' => '',
            'container_with_sidebar' => $container_with_sidebar,
            'content_side' => $content_side,
            'page_content' => $page_content,
            'tasks' => $tasks,
            'active_tasks' => $active_tasks,
            'projects' => $projects,
            'title' => 'Дела в порядке'
        ]
    );
}


print ($layout_content);
