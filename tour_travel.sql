CREATE DATABASE travel_site;

USE travel_site;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);


CREATE TABLE IF NOT EXISTS book_form (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    address VARCHAR(255),
    location VARCHAR(100),
    guests INT,
    arrivals DATE,
    leaving DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

