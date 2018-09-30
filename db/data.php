<?php

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
    'deadline' => '24.09.2018',
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
    'deadline' => null,
    'category' => $projects[3],
    'isDone' => false
    ],
    [
    'title' => 'Заказать пиццу',
    'deadline' => null,
    'category' => $projects[3],
    'isDone' => false
    ]
];
