USE doingsdone_manual;

/*Существующий список проектов*/
INSERT INTO project (title, author, user_id)
VALUES
      ('Входящие', 'iashchuk', 1),
      ('Учеба', 'iashchuk', 1),
      ('Работа', 'iashchuk', 1),
      ('Домашние дела', 'keks', 2),
      ('Авто', 'keks', 2);

/*Придумайте пару пользователей*/
INSERT INTO user (created, email, name, password, contacts)
VALUES
      ('2018-09-17', '221box@list.ru', 'Виталий', 'qwerty', 'Moscow'),
      ('2018-09-17', 'keks@htmlacademy.ru', 'Кекс', 'povelitel', 'HTML Academy');

/*Список задач*/
INSERT INTO task (title, created, status, deadline, user_id, project_id)
VALUES
      ('Собеседование в IT компании', '2018.09.17', 0, '2018.12.01', 1, 3),
      ('Выполнить тестовое задание', '2018.09.17', 0, '2018.09.24', 1, 3),
      ('Сделать задание первого раздела', '2018.09.17', 1, '2018.12.21', 1, 2),
      ('Встреча с другом', '2018.09.17', 0, '2018.12.22', 2, 1),
      ('Купить корм для кота', '2018.09.17', 0, NULL, 2, 4),
      ('Заказать пиццу', '2018.09.17', 0, NULL, 2, 4);


/*получить список из всех проектов для одного пользователя*/
SELECT * FROM project WHERE user_id = 1;

/*получить список из всех задач для одного проекта*/
SELECT * FROM task WHERE project_id = 2;

/*пометить задачу как выполненную*/
UPDATE task SET status = 1 WHERE id = 3;

/*получить все задачи для завтрашнего дня*/
SELECT * FROM task WHERE deadline = '2018-09-24';

/*обновить название задачи по её идентификатору*/
UPDATE task SET title='Купить очень много корма для кота' WHERE id = 5;
