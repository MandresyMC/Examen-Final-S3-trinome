CREATE DATABASE takalo;
USE takalo;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(100) NOT NULL
);

CREATE TABLE categorie (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(50) NOT NULL
);

CREATE TABLE objets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  idCategorie INT NOT NULL,
  idUser INT NOT NULL,
  titre VARCHAR(100) NOT NULL,
  description TEXT,
  photo VARCHAR(100) NOT NULL,
  prix DOUBLE
);

CREATE TABLE echange (
  id INT AUTO_INCREMENT PRIMARY KEY,
  idObjet1 INT NOT NULL, -- objet hangatahana
  idObjet2 INT NOT NULL, -- objet ho alefa
  etat VARCHAR(10) DEFAULT "en attente",
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  modified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO users (email, password) VALUES
('alice@gmail.com', 'alice123'),
('bob@gmail.com', 'bob123'),
('charlie@gmail.com', 'charlie123');

INSERT INTO categorie (nom) VALUES
('Électronique'),
('Maison'),
('Vêtements'),
('Livres');

INSERT INTO objets (idCategorie, idUser, titre, description, photo, prix) VALUES
(1, 1, 'Téléphone Samsung', 'Téléphone Android en bon état', 'samsung.jpg', 450000),
(1, 2, 'Ordinateur Portable HP', 'HP Core i5, 8Go RAM', 'hp_laptop.jpg', 1200000),
(2, 1, 'Table en bois', 'Table pour salle à manger', 'table_bois.jpg', 300000),
(3, 3, 'Veste en cuir', 'Veste noire taille M', 'veste.jpg', 150000),
(4, 2, 'Livre PHP', 'Apprendre PHP et MySQL', 'php_book.jpg', 50000);

