CREATE DATABASE IF NOT EXISTS cybercrime;
USE cybercrime;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(100),
    role VARCHAR(20)
);
CREATE TABLE complaints (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    description TEXT,
    username VARCHAR(50),
    assigned_to VARCHAR(50),
    status VARCHAR(20) DEFAULT 'Pending'
);