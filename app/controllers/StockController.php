<?php

class StockController {

    public static function showFormulaireStock() {
        $pdo = Flight::db();
        $repoProduit = new ProduitRepository($pdo);

        $produits = $repoProduit->findAll();

        $success = null;
        if (isset(Flight::request()->query['success'])) {
            $success = Flight::request()->query['success'];
        }

        $error = null;
        if (isset(Flight::request()->query['error'])) {
            $error = Flight::request()->query['error'];
        }

        Flight::render('formulaire_stock', [
            'produits' => $produits,
            'success' => $success,
            'error' => $error,
        ]);
    }

    public static function saveStock() {
        $pdo = Flight::db();
        $repoStock = new StockDonsRepository($pdo);
        $repoProduit = new ProduitRepository($pdo);

        $idProduit = Flight::request()->data['idProduit'];
        $quantite_initiale = Flight::request()->data['quantite_initiale'];
        $quantite_finale   = $quantite_initiale;;

        $produit = $repoProduit->findById($idProduit);
        $error = null;
        if (!$produit) {
            $error = "Produit introuvable.";
        }

        if ($error) {
            Flight::redirect('/formulaire_stock?error=' . urlencode($error));
            return;
        }

        // $id = $repoStock->create($produit['idCategorie'], $idProduit, $quantite_initiale, $quantite_finale);

        $success = "Le produit '{$produit['nom']}' a été ajouté au stock avec succès";

        Flight::redirect('/formulaire_stock?success=' . urlencode($success));
    }
}
