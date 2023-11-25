To get started run the following SQL commands:

CREATE DATABASE misc;
CREATE USER 'azhar'@'localhost' IDENTIFIED BY 'azhar.mypassword$123#';
GRANT ALL ON misc.* TO 'azhar'@'localhost';

USE misc; (Or select misc in phpMyAdmin)

CREATE TABLE users (
    user_id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(128),
    email VARCHAR(128) UNIQUE,
    password VARCHAR(128),
    INDEX(email)
) ENGINE=InnoDB CHARSET=utf8mb4;