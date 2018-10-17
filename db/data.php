<?php

$projects = [
    [
    'id' => 1,
    'title' =>'Входящие',
    'author' => 'iashchuk',
    'user_id' => 1
    ],
    [
    'id' => 2,
    'title' =>'Учеба',
    'author' => 'iashchuk',
    'user_id' => 1
    ],
    [
    'id' => 3,
    'title' =>'Работа',
    'author' => 'iashchuk',
    'user_id' => 1
    ],
    [
    'id' => 4,
    'title' =>'Домашние дела',
    'author' => 'keks',
    'user_id' => 2
    ],
    [
    'id' => 5,
    'title' =>'Авто',
    'author' => 'keks',
    'user_id' => 2
    ]
];

$tasks = [
    [
    'id' => 1,
    'title' => 'Собеседование в IT компании',
    'created' => '17.09.2018',
    'deadline' => '01.12.2018',
    'category' => $projects[2],
    'status' => false,
    'user_id' => 1,
    'project_id' => 3
    ],
    [
    'id' => 2,
    'title' => 'Выполнить тестовое задание',
    'created' => '17.09.2018',
    'deadline' => '24.09.2018',
    'category' => $projects[2],
    'status' => false,
    'user_id' => 1,
    'project_id' => 3
    ],
    [
    'id' => 3,
    'title' => 'Сделать задание первого раздела',
    'created' => '17.09.2018',
    'deadline' => '21.12.2018',
    'category' => $projects[1],
    'status' => true,
    'user_id' => 1,
    'project_id' => 2
    ],
    [
    'id' => 4,
    'title' => 'Встреча с другом',
    'created' => '17.09.2018',
    'deadline' => '22.12.2018',
    'category' => $projects[0],
    'status' => false,
    'user_id' => 2,
    'project_id' => 1
    ],
    [
    'id' => 5,
    'title' => 'Купить корм для кота',
    'created' => '17.09.2018',
    'deadline' => null,
    'category' => $projects[3],
    'status' => false,
    'user_id' => 2,
    'project_id' => 4
    ],
    [
    'id' => 6,
    'title' => 'Заказать пиццу',
    'created' => '17.09.2018',
    'deadline' => null,
    'category' => $projects[3],
    'status' => false,
    'user_id' => 2,
    'project_id' => 4
    ]
];
