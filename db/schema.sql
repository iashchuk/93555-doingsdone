CREATE DATABASE IF NOT EXISTS `doingsdone_manual`
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE `doingsdone_manual`;

CREATE TABLE IF NOT EXISTS `projects` (
  `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `title` CHAR(64) NOT NULL,
  -- `author` CHAR(64) NOT NULL,
  `user_id` INT NOT NULL
) ENGINE = INNODB CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `title` VARCHAR(64) NOT NULL,
  `created` DATETIME NOT NULL,
  `done` DATETIME DEFAULT NULL,
  `status` INT DEFAULT 0,
  `file` VARCHAR(255) DEFAULT NULL,
  `deadline` DATETIME DEFAULT NULL,
  `user_id` INT NOT NULL,
  `project_id` INT
  -- `project_id` INT NOT NULL

) ENGINE = INNODB CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `created` DATETIME NOT NULL,
  `email` VARCHAR(64) NOT NULL,
  `name` VARCHAR(64) NOT NULL,
  `password` CHAR(64) NOT NULL,
  `contacts` VARCHAR(255) NOT NULL
) ENGINE = INNODB CHARACTER SET = utf8;

CREATE UNIQUE INDEX `email` ON `users`(`email`);
CREATE INDEX `task` ON `tasks`(`title`);
CREATE FULLTEXT INDEX `tasks_search` ON `tasks`(`title`);
