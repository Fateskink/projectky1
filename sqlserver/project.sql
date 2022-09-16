CREATE DATABASE projectNhom1;
USE projectNhom1;

CREATE TABLE  projectNhom1_users(
    ID INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    phone INT NOT NULL,
    password VARCHAR(255) NOT NULL,
    admin INT default 0
);

INSERT INTO projectNhom1_users(email,phone,password,admin) VALUES
('addmin@gmail.com',987654321,123123,1),
('addmin1@gmail.com',987654321,123123,1);

