
CREATE DATABASE finance_tracker;
USE finance_tracker;

CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(50),
 email VARCHAR(50) UNIQUE,
 password VARCHAR(255)
);

CREATE TABLE expenses (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT,
 amount DECIMAL(10,2),
 category VARCHAR(50),
 date DATE,
 description VARCHAR(100)
);

CREATE TABLE income (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT,
 source VARCHAR(50),
 amount DECIMAL(10,2),
 frequency VARCHAR(20)
);

CREATE TABLE budgets (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT,
 category VARCHAR(50),
 monthly_limit DECIMAL(10,2)
);
