<?php

class ProduitController {

   public function saveProduit() {
        $pdo = Flight::db();

        $repoProduit = new ProduitRepository($pdo);

        $nomProduit = Flight::request()->data['nomProduit'];
        $prixUnitaire = Flight::request()->data['prixUnitaire'];
        $idCategorie = Flight::request()->data['idCategorie'];


        if (!$produit) {
            $error = "Produit introuvable.";
        }

        $idProduit = $repoProduit->addProduit($nomProduit, $prixUnitaire, $idCategorie);

        $success = "Produit ajouté avec succès";

        Flight::redirect('/formulaire_produit?success=' . urlencode($success));
    }

}
