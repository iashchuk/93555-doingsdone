<?php

require_once ('functions.php');

// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);
$projects = ['Входящие', 'Учеба', 'Работа', 'Домашние дела', 'Авто'];

$tasks = [
    [
    'title' => 'Собеседование в IT компании',
    'deadline' => '01.12.2018',
    'category' => $projects[2],
    'isDone' => false
    ],
    [
    'title' => 'Выполнить тестовое задание',
    'deadline' => '25.12.2018',
    'category' => $projects[2],
    'isDone' => false
    ],
    [
    'title' => 'Сделать задание первого раздела',
    'deadline' => '21.12.2018',
    'category' => $projects[1],
    'isDone' => true
    ],
    [
    'title' => 'Встреча с другом',
    'deadline' => '22.12.2018',
    'category' => $projects[0],
    'isDone' => false
    ],
    [
    'title' => 'Купить корм для кота',
    'deadline' => 'Нет',
    'category' => $projects[3],
    'isDone' => false
    ],
    [
    'title' => 'Заказать пиццу',
    'deadline' => 'Нет',
    'category' => $projects[3],
    'isDone' => false
    ]
];

$page_content = include_template (
    'index.php',
    [
        'show_complete_tasks' => $show_complete_tasks,
        'tasks' => $tasks
    ]
);

$layout_content = include_template (
    'layout.php',
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
