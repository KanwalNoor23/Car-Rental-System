CREATE DATABASE IF NOT EXISTS car_rental;
USE car_rental;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255)
);

CREATE TABLE cars (
  id INT AUTO_INCREMENT PRIMARY KEY,
  model VARCHAR(100),
  brand VARCHAR(100),
  price_per_day DECIMAL(10,2),
  status VARCHAR(20) DEFAULT 'available'
);

CREATE TABLE bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  car_id INT,
  start_date DATE,
  end_date DATE,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (car_id) REFERENCES cars(id)
);

CREATE TABLE admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100),
  password VARCHAR(255)
);

-- Sample Data
INSERT INTO users (name, email, password) VALUES
('Ali Khan', 'ali@example.com', '12345'),
('Sara Mirza', 'sara@example.com', '12345'),
('Ahmed Raza', 'ahmed@example.com', '12345');

INSERT INTO cars (model, brand, price_per_day) VALUES
('Civic', 'Honda', 50.00),
('Corolla', 'Toyota', 45.00),
('Sportage', 'Kia', 70.00);

INSERT INTO bookings (user_id, car_id, start_date, end_date) VALUES
(1, 2, '2025-05-01', '2025-05-05'),
(2, 3, '2025-05-10', '2025-05-12');
