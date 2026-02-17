<?php

class ReinitialiserRepository {
    private $pdo;
    public function __construct(PDO $pdo) { $this->pdo = $pdo; }

    public function reinitialiser() {
    try {
        $this->pdo->exec("TRUNCATE TABLE besoin");
        $this->pdo->exec("TRUNCATE TABLE dons");
        $this->pdo->exec("TRUNCATE TABLE achats");
        $this->pdo->exec("TRUNCATE TABLE stocks");
        $this->pdo->exec("TRUNCATE TABLE produit");
        $this->pdo->exec("TRUNCATE TABLE categorie");
        $this->pdo->exec("TRUNCATE TABLE ville");
        $this->pdo->exec("TRUNCATE TABLE commission");

        $this->pdo->exec("
            INSERT INTO ville (nom) VALUES
            ('Toamasina'),
            ('Mananjary'),
            ('Farafangana'),
            ('Nosy Be'),
            ('Morondava')
        ");

        $this->pdo->exec("
            INSERT INTO categorie (nom) VALUES
            ('nature'),
            ('materiel'),
            ('argent')
        ");

        $this->pdo->exec("
            INSERT INTO produit (nom, idCategorie, prixUnitaire) VALUES
            ('Riz (kg)', 1, 3000),
            ('Eau (L)', 1, 1000),
            ('Huile (L)', 1, 6000),
            ('Haricots', 1, 4000),
            ('Tôle', 2, 25000),
            ('Bâche', 2, 15000),
            ('Clous (kg)', 2, 8000),
            ('Bois', 2, 10000),
            ('Argent', 3, 1)
        ");

        $this->pdo->exec("
            INSERT INTO besoin (idCategorie, idVille, idProduit, quantiteDemandee) VALUES
            (1, 1, 1, 800),
            (1, 1, 2, 1500),
            (2, 1, 5, 120),
            (2, 1, 6, 200),
            (3, 1, 9, 12000000)
        ");

        $this->pdo->exec("
            INSERT INTO besoin (idCategorie, idVille, idProduit, quantiteDemandee) VALUES
            (1, 2, 1, 500),
            (1, 2, 3, 120),
            (2, 2, 5, 80),
            (2, 2, 7, 60),
            (3, 2, 9, 6000000)
        ");

        $this->pdo->exec("
            INSERT INTO besoin (idCategorie, idVille, idProduit, quantiteDemandee) VALUES
            (1, 3, 1, 600),
            (1, 3, 2, 1000),
            (2, 3, 6, 150),
            (2, 3, 8, 100),
            (3, 3, 9, 8000000)
        ");

        $this->pdo->exec("
            INSERT INTO besoin (idCategorie, idVille, idProduit, quantiteDemandee) VALUES
            (1, 4, 1, 300),
            (1, 4, 4, 200),
            (2, 4, 5, 40),
            (2, 4, 7, 30),
            (3, 4, 9, 4000000)
        ");

        $this->pdo->exec("
            INSERT INTO besoin (idCategorie, idVille, idProduit, quantiteDemandee) VALUES
            (1, 5, 1, 700),
            (1, 5, 2, 1200),
            (2, 5, 6, 180),
            (2, 5, 8, 150),
            (3, 5, 9, 10000000)
        ");

        $this->pdo->exec("
            INSERT INTO commission (pourcentage) VALUES (10.0)
        ");

    } catch (PDOException $e) {
        die("Erreur lors de la réinitialisation : " . $e->getMessage());
    }
}

}