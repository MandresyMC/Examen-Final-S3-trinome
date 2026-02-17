INSERT INTO ville (nom, fond) VALUES
('Toamasina', 0),
('Mananjary', 0),
('Farafangana', 0),
('Nosy Be', 0),
('Morondava', 0);

INSERT INTO categorie (nom) VALUES
('nature'),
('materiel'),
('argent');

INSERT INTO produit (nom, idCategorie, prixUnitaire) VALUES
('Riz (kg)', 1, 3000),
('Eau (L)', 1, 1000),
('Huile (L)', 1, 6000),
('Haricots', 1, 4000),

('Tôle', 2, 25000),
('Bâche', 2, 15000),
('Clous (kg)', 2, 8000),
('Bois', 2, 10000),

('Argent', 3, 1);

-- TOAMASINA
INSERT INTO besoin (idCategorie, idVille, idProduit, quantiteDemandee) VALUES
(1, 1, 'Riz (kg)', 800),
(1, 1, 'Eau (L)', 1500),
(2, 1, 'Tôle', 120),
(2, 1, 'Bâche', 200),
(3, 1, 'Argent', 12000000);

-- MANANJARY
INSERT INTO besoin VALUES
(NULL, 1, 2, 'Riz (kg)', 500),
(NULL, 1, 2, 'Huile (L)', 120),
(NULL, 2, 2, 'Tôle', 80),
(NULL, 2, 2, 'Clous (kg)', 60),
(NULL, 3, 2, 'Argent', 6000000);

-- FARAFANGANA
INSERT INTO besoin VALUES
(NULL, 1, 3, 'Riz (kg)', 600),
(NULL, 1, 3, 'Eau (L)', 1000),
(NULL, 2, 3, 'Bâche', 150),
(NULL, 2, 3, 'Bois', 100),
(NULL, 3, 3, 'Argent', 8000000);

-- NOSY BE
INSERT INTO besoin VALUES
(NULL, 1, 4, 'Riz (kg)', 300),
(NULL, 1, 4, 'Haricots', 200),
(NULL, 2, 4, 'Tôle', 40),
(NULL, 2, 4, 'Clous (kg)', 30),
(NULL, 3, 4, 'Argent', 4000000);

-- MORONDAVA
INSERT INTO besoin VALUES
(NULL, 1, 5, 'Riz (kg)', 700),
(NULL, 1, 5, 'Eau (L)', 1200),
(NULL, 2, 5, 'Bâche', 180),
(NULL, 2, 5, 'Bois', 150),
(NULL, 3, 5, 'Argent', 10000000);



-----------
-----------
---stock dons ---------
-----------
-----------

INSERT INTO stockDons (idCategorie, idProduit, quantiteInitiale, quantiteFinale) VALUES
(3, 'Argent', 39500000, 39500000),

(1, 'Riz (kg)', 2400, 2400),
(1, 'Eau (L)', 5600, 5600),
(1, 'Haricots', 188, 188),

(2, 'Tôle', 350, 350),
(2, 'Bâche', 570, 570);