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

-- CREATE TABLE dons (
--     id INT PRIMARY KEY AUTO_INCREMENT,
--     idVille INT, -- ville omena
--     idStock INT,
--     quantiteDonnee DOUBLE NOT NULL,
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
-- );

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

CREATE TABLE dons (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idVille INT, -- ville omena
    idStock INT,
    idBesoin INT,
    quantiteDonnee DOUBLE NOT NULL,
    statut VARCHAR(50) DEFAULT 'attribuer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
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
    quantite INT, -- Qte a achete
    prix DOUBLE, -- prix de l'achat
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- V3

CREATE TABLE vente (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idDons INT, -- dons a vendre
    idCommission INT, -- commission
    prixVente DOUBLE
);

CREATE TABLE commission (
    id INT PRIMARY KEY AUTO_INCREMENT,
    pourcentage DOUBLE -- commission en pourcentage
);

INSERT INTO commission (pourcentage) VALUES (10.0);
-- ALTER TABLE dons ADD COLUMN statut VARCHAR(50) DEFAULT 'attribuer';