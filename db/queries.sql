USE `doingsdone_manual`;

/*Существующий список проектов*/
INSERT INTO projects (title, user_id)
VALUES
      ('Входящие', 1),
      ('Учеба', 1),
      ('Работа', 1),
      ('Домашние дела', 2),
      ('Авто', 2);

/*Придумайте пару пользователей*/
INSERT INTO users (created, email, name, password, contacts)
VALUES
      ('2018-09-17', 'id93555@mail.ru', 'Виталий', '$10$N/bgOieTbrBDYWbAakD6Leue6.bLQ1S/MxfC1KvJyJlmaL6Qn0lsm', 'Moscow'),
      ('2018-09-17', 'keks@htmlacademy.ru', 'Кекс', '$10$gKltkDdB.LhXrLf/7EGwGu2qgLfDzwGP3yXIvltLaYILeb3zpZ5JK', 'HTML Academy');

/*Список задач*/
INSERT INTO tasks (title, created, status, deadline, user_id, project_id)
VALUES
      ('Собеседование в IT компании', '2018.09.17', 0, '2018.12.01', 1, 3),
      ('Выполнить тестовое задание', '2018.09.17', 0, '2018.09.24', 1, 3),
      ('Сделать задание первого раздела', '2018.09.17', 1, '2018.12.21', 1, 2),
      ('Встреча с другом', '2018.09.17', 0, '2018.12.22', 2, 1),
      ('Купить корм для кота', '2018.09.17', 0, NULL, 2, 4),
      ('Заказать пиццу', '2018.09.17', 0, NULL, 2, 4);


/*получить список из всех проектов для одного пользователя*/
SELECT * FROM projects WHERE user_id = 1;

/*получить список из всех задач для одного проекта*/
SELECT * FROM tasks WHERE project_id = 2;

/*пометить задачу как выполненную*/
UPDATE tasks SET status = 1 WHERE id = 3;

/*получить все задачи для завтрашнего дня*/
SELECT * FROM tasks WHERE deadline = DATE_ADD(CURDATE(), INTERVAL 1 DAY);

/*обновить название задачи по её идентификатору*/
UPDATE tasks SET title='Купить очень много корма для кота' WHERE id = 5;
