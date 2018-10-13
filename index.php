<?php

require_once ('./root/config.php');
require_once ('./root/constants.php');
require_once ('./root/functions.php');
require_once ('./root/db_connect.php');
require_once ('./root/db_queries.php');
require_once ('./root/db_data.php');
require_once ('./root/db_utils.php');

$body_background = 'body-background';
$sql_projects = get_user_project_query($user_id);
$projects = db_select($connect, $sql_projects);

$sql_tasks = get_user_tasks_query($user_id);
$tasks = db_select($connect, $sql_tasks);

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
    $content_side = include_template('content-side', [
        'projects' => $projects,
        'tasks' => $tasks,
        'active_tasks' => $active_tasks,
    ]);

    $page_content = include_template('index', [
        'show_complete_tasks' => $show_complete_tasks,
        'tasks' => $tasks,
    ]);

    $layout_content = include_template('layout', [
        'body_background' => '',
        'container_with_sidebar' => $container_with_sidebar,
        'content_side' => $content_side,
        'page_content' => $page_content,
        'tasks' => $tasks,
        'active_tasks' => $active_tasks,
        'projects' => $projects,
         'title' => 'Дела в порядке'
    ]);
}


print ($layout_content);
