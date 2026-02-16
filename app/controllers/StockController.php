<?php

class StockController {

    public static function showFormulaireStock() {
        $pdo = Flight::db();
        $repoCategorie = new CategorieRepository($pdo);

        $categories = $repoCategorie->findAll();

        Flight::render('formulaire_stock', [
            'categories' => $categories
        ]);
    }

    public static function saveStock() {
        $pdo = Flight::db();
        $repoStock = new StockDonsRepository($pdo);

        $cat = $_POST['cat'];
        $nom = $_POST['nom'];
        $quantite_initiale = $_POST['quantite_initiale'];
        $quantite_finale   = $_POST['quantite_finale'];

        $id = $repoStock->create($cat, 0, $nom, $quantite_initiale, $quantite_finale); 
        // ici 0 pour ville_id car stockDons n'a pas besoin de ville

        echo "<div class='alert alert-success text-center mt-3'>
                Le produit '$nom' a été ajouté au stock avec succès ! (ID: $id)
              </div>";
    }
}
