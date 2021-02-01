CREATE TABLE users (
    id       INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(64) NOT NULL
);

CREATE TABLE tasks (
    id       INT PRIMARY KEY AUTO_INCREMENT,
    task     VARCHAR(255),
    finished BOOLEAN DEFAULT false,
    user_id  INT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);