-- Create database if not exists
CREATE DATABASE IF NOT EXISTS client_management;
USE client_management;

-- Create accounts table
CREATE TABLE IF NOT EXISTS accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    company_name VARCHAR(100),
    position VARCHAR(100),
    phone1 VARCHAR(20),
    phone2 VARCHAR(20),
    phone3 VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Add some test data (optional)
INSERT INTO accounts (first_name, last_name, email, company_name, position, phone1) 
VALUES 
('John', 'Doe', 'john.doe@example.com', 'Test Company', 'Manager', '+1234567890'),
('Jane', 'Smith', 'jane.smith@example.com', 'Another Company', 'Developer', '+0987654321');