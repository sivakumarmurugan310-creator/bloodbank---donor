-- Create database
CREATE DATABASE IF NOT EXISTS bloodbank;
USE bloodbank;

-- Admin table
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
);

-- Insert default admin
INSERT INTO admin(username,password) VALUES ('admin','1234');

-- Donors table
CREATE TABLE IF NOT EXISTS donors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL UNIQUE,
    alt_phone VARCHAR(15),
    email VARCHAR(50),
    blood_group VARCHAR(5) NOT NULL,
    password VARCHAR(50) NOT NULL,
    latitude DOUBLE,
    longitude DOUBLE
);

-- Requests table
CREATE TABLE IF NOT EXISTS requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    blood_group VARCHAR(5) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    priority VARCHAR(10) NOT NULL,
    request_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);