<?php


class BesoinController {

    public function showFormulaireBesoin() {
        $pdo = Flight::db(); 
        $repoVille = new VilleRepository($pdo);
        $repoProduit = new ProduitRepository($pdo);

        $villes = $repoVille->findAll();
        $produits = $repoProduit->findAll();

        $success = null;
        if (isset(Flight::request()->query['success'])) {
            $success = Flight::request()->query['success'];
        }

        $error = null;
        if (isset(Flight::request()->query['error'])) {
            $error = Flight::request()->query['error'];
        }

        Flight::render('formulaire_besoin', [
            'villes' => $villes,
            'produits' => $produits,
            'success' => $success,
            'error' => $error,
        ]);
    }

    public function saveBesoin() {
        $pdo = Flight::db();
        $repoBesoin = new BesoinRepository($pdo);
        $repoProduit = new ProduitRepository($pdo);

        $ville = Flight::request()->query['ville'];
        $idProduit = Flight::request()->query['idProduit'];
        $quantiteDemandee = Flight::request()->query['quantite'];

        $produit = $repoProduit->findById($idProduit);
        $error = null;
        if (!$produit) {
            $error = "Produit introuvable.";
        }

        if ($error) {
            Flight::redirect('/formulaire_besoin?error=' . urlencode($error));
            return;
        }

        $idBesoin = $repoBesoin->create($produit['idCategorie'], $ville, $idProduit, $quantiteDemandee);

        $success = "Besoin ajouté avec succès";

        Flight::redirect('/formulaire_besoin?success=' . urlencode($success));
    }
}
