<?php


class BesoinController {

    public function showFormulaireBesoin() {
        $pdo = Flight::db(); 
        $repoVille = new VilleRepository($pdo);
        $repoProduit = new ProduitRepository($pdo);

        $villes = $repoVille->findAll();
        $produits = $repoProduit->findAll();

        Flight::render('formulaire_besoin', [
            'villes' => $villes,
            'produits' => $produits
        ]);
    }

    public function saveBesoin() {
        $pdo = Flight::db();
        $repoBesoin = new BesoinRepository($pdo);
        $repoProduit = new ProduitRepository($pdo);

        $ville = $_POST['ville'];
        $idProduit = $_POST['idProduit'];
        $quantiteDemandee = $_POST['quantite'];

        $produit = $repoProduit->findById($idProduit);
        if (!$produit) {
            echo "<div class='alert alert-danger text-center mt-3'>Produit introuvable.</div>";
            return;
        }

        $idBesoin = $repoBesoin->create($produit['idCategorie'], $ville, $idProduit, $quantiteDemandee);

        echo "<div class='alert alert-success text-center mt-3'>
            Le besoin pour '{$produit['nom']}' a été ajouté avec succès ! (ID: $idBesoin)
              </div>";
    }
}
