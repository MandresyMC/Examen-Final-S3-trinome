<?php

class StockController {

    public static function showFormulaireStock() {
        $pdo = Flight::db();
        $repoProduit = new ProduitRepository($pdo);

        $produits = $repoProduit->findAll();

        Flight::render('formulaire_stock', [
            'produits' => $produits
        ]);
    }

    public static function saveStock() {
        $pdo = Flight::db();
        $repoStock = new StockDonsRepository($pdo);
        $repoProduit = new ProduitRepository($pdo);

        $idProduit = $_POST['idProduit'];
        $quantite_initiale = $_POST['quantite_initiale'];
        $quantite_finale   = $quantite_initiale;;

        $produit = $repoProduit->findById($idProduit);
        if (!$produit) {
            echo "<div class='alert alert-danger text-center mt-3'>Produit introuvable.</div>";
            return;
        }

        $id = $repoStock->create($produit['idCategorie'], $idProduit, $quantite_initiale, $quantite_finale);

        echo "<div class='alert alert-success text-center mt-3'>
                Le produit '{$produit['nom']}' a été ajouté au stock avec succès ! (ID: $id)
              </div>";
    }
}
