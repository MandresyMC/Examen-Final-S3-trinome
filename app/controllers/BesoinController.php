<?php


class BesoinController {

    public function showFormulaireBesoin() {
        $pdo = Flight::db(); 
        $repoVille = new VilleRepository($pdo);
        $repoCategorie = new CategorieRepository($pdo);

        $villes = $repoVille->findAll();
        $categories = $repoCategorie->findAll();

        Flight::render('formulaire_besoin', [
            'villes' => $villes,
            'categories' => $categories
        ]);
    }

    public function saveBesoin() {
        $pdo = Flight::db();
        $repoBesoin = new BesoinRepository($pdo);

        $ville = $_POST['ville'];
        $cat = $_POST['cat'];
        $nomProduit = $_POST['nom'];
        $quantiteDemandee = $_POST['quantite'];

        $idBesoin = $repoBesoin->create($cat, $ville, $nomProduit, $quantiteDemandee);

        echo "<div class='alert alert-success text-center mt-3'>
                Le besoin '$nomProduit' a été ajouté avec succès ! (ID: $idBesoin)
              </div>";
    }
}
