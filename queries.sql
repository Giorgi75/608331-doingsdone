-- Заполняем список пользователей
INSERT INTO users(date_signup, email, name, password, contacts)
VALUES ('2018-03-01 00:00:00', 'pascal@gmail.com',  'Паскаль',   'password1',  'Pascal123'),
       ('2018-03-02 11:59:59', 'chantal@gmail.com', 'Шанталь', 'password2',  'Chantal123'),
       ('2018-03-03 23:59:59', 'gregory@gmail.com',  'Грегори',   'password3',  ('Gregory123'));

-- Заполняем список проектов
INSERT INTO projects(name, alias, user_id)
VALUES ('Входящие', 'incoming', 1),
       ('Учеба', 'learning', 2),
       ('Работа', 'work', 3),
       ('Домашние дела', 'homework', 1),
       ('Авто', 'auto', 2);

-- Заполняем список задач
INSERT INTO tasks(date_created, date_completed, name, file, task_deadline, user_id, project_id)
VALUES ('2018-03-02 00:00:00', null, 'Собеседование в IT компании', '', '2018-06-01 00:00:00', 1, 3),
       ('2018-03-03 00:00:00', null, 'Выполнить тестовое задание', '', '2018-05-25 00:00:00', 1, 3),
       ('2018-03-04 00:00:00', '2018-04-21 15:23:02', 'Сделать задание первого раздела', '', '2018-04-21 00:00:00', 1, 2),
       ('2018-03-05 00:00:00', null, 'Встреча с другом', '', '2018-04-22 00:00:00', 1, 1),
       ('2018-03-06 00:00:00', null, 'Купить корм для кота', '', null, 1, 4),
       ('2018-03-07 00:00:00', null, 'Заказать пиццу', '', null, 1, 4);

-- получить список из всех проектов для одного пользователя
SELECT * FROM projects
WHERE user_id = 1;

-- получить список из всех задач для одного проекта
SELECT * FROM tasks
WHERE project_id = 4;

-- пометить задачу как выполненную
UPDATE tasks SET task_completed = NOW()
WHERE id = 1;

-- получить все задачи для завтрашнего дня
SELECT * FROM tasks
WHERE task_deadline >= CURDATE() + INTERVAL 1 DAY AND task_deadline < CURDATE() + INTERVAL 2 DAY;

-- обновить название задачи по её идентификатору
UPDATE tasks SET name = 'Заказать пиццу пиперони'
WHERE id = 6;


-- Добавляем дополнительные данные для тестирования

-- Список проектов
INSERT INTO projects(name, user_id)
VALUES ('Путешествие',      2),
       ('Кино',         2),
       ('Пейнтбол',        3),
       ('Кодинг', 3);

-- Список задач
INSERT INTO tasks(date_created, date_completed, name, file, task_deadline, user_id, project_id)
VALUES ('2018-03-02 00:00:00', null, 'Купить билеты на самолет', '', '2018-06-01 00:00:00', 2, 6),
       ('2018-03-03 00:00:00', null, 'Сходить в кино', '', '2018-05-25 00:00:00', 2, 7),
       ('2018-03-04 00:00:00', null , 'Сходить с друзями в клуб для игры в пейнтбол', '', '2018-06-21 00:00:00', 3, 8),
       ('2018-03-05 00:00:00', null, 'Поправить форму входа на сайт для клиента', '', '2018-05-22 00:00:00', 3, 9);
