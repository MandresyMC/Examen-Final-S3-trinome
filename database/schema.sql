CREATE DATABASE exam_s3;
USE exam_s3;

CREATE TABLE ville (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE categorie (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL
);

-- CREATE TABLE besoin (
--     id INT PRIMARY KEY AUTO_INCREMENT,
--     idCategorie INT,
--     idVille INT, -- ville mangataka
--     nomProduit VARCHAR(255) NOT NULL, -- ex : riz, huile, tole
--     quantiteDemandee DOUBLE NOT NULL
-- );

-- CREATE TABLE stockDons (
--     id INT PRIMARY KEY AUTO_INCREMENT,
--     idCategorie INT,
--     nomProduit VARCHAR(255) NOT NULL, -- ex : riz, huile, tole
--     quantiteInitiale DOUBLE NOT NULL,
--     quantiteFinale DOUBLE NOT NULL
-- );

CREATE TABLE dons (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idVille INT, -- ville omena
    idStock INT,
    quantiteDonnee DOUBLE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- V2

ALTER TABLE ville ADD COLUMN fond DOUBLE DEFAULT 0;

CREATE TABLE produit (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    idCategorie INT,
    prixUnitaire DOUBLE -- par kg
);

CREATE TABLE besoin (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idCategorie INT,
    idVille INT, -- ville mangataka
    idProduit VARCHAR(255) NOT NULL,
    quantiteDemandee DOUBLE NOT NULL
);

CREATE TABLE stockDons (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idCategorie INT,
    idProduit VARCHAR(255) NOT NULL, -- ex : riz, huile, tole
    quantiteInitiale DOUBLE NOT NULL,
    quantiteFinale DOUBLE NOT NULL
);

CREATE TABLE achat (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idVille INT, -- ville manao achat
    idStock INT, -- stock (produit) hovidiana
    idDon INT, -- don (produit) hividianana
    quantite INT, -- Qte a achete
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
ALTER TABLE achat ADD COLUMN quantite INT DEFAULT 0;
