CREATE DATABASE doingsdone_manual
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE doingsdone_manual;

CREATE TABLE project (
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  title CHAR(64) NOT NULL,
  author CHAR(64) NOT NULL,
  user_id INT NOT NULL
);

CREATE TABLE task (
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  title CHAR(64) NOT NULL,
  created DATE NOT NULL,
  done DATE DEFAULT NULL,
  status INT DEFAULT 0,
  file CHAR(255) DEFAULT NULL,
  deadline DATE DEFAULT NULL,
  user_id INT NOT NULL,
  project_id INT NOT NULL

);

CREATE TABLE user (
  id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  created DATE NOT NULL,
  email CHAR(64) NOT NULL,
  name CHAR(64) NOT NULL,
  password CHAR(64) NOT NULL,
  contacts CHAR(255) NOT NULL
);

CREATE UNIQUE INDEX email ON user(email);
CREATE INDEX task ON task(name);
