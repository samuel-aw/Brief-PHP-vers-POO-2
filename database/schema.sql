CREATE DATABASE IF NOT EXISTS mediatheque_poo
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE mediatheque_poo;

DROP TABLE IF EXISTS resources;

CREATE TABLE resources (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(150) NOT NULL,
  type VARCHAR(80) NOT NULL,
  status VARCHAR(40) NOT NULL DEFAULT 'disponible',
  borrower VARCHAR(120) NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO resources (title, type, status, borrower) VALUES
('Clean Code', 'livre', 'disponible', NULL),
('Kit Arduino Uno', 'materiel', 'emprunte', 'Amina'),
('Casque audio USB', 'materiel', 'maintenance', NULL),
('Support PHP POO', 'support de cours', 'disponible', NULL),
('Ordinateur portable Lenovo', 'ordinateur', 'emprunte', 'Mehdi');

