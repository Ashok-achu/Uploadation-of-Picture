CREATE DATABASE shanmugam_associates;

CREATE TABLE users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE projects (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11),
    file_path VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
