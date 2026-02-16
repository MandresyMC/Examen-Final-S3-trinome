<?php
class BesoinController {

    public static function showFormulaire() {
        $villes = [
            ['id' => 1, 'nom' => 'Antananarivo'],
            ['id' => 2, 'nom' => 'Fianarantsoa'],
            ['id' => 3, 'nom' => 'Toamasina']
        ];

        $categories = [
            ['id' => 1, 'nom' => 'Nature'],
            ['id' => 2, 'nom' => 'Matériaux'],
            ['id' => 3, 'nom' => 'Argents']
        ];

        Flight::render('formulaire_besoin', [
            'villes' => $villes,
            'categories' => $categories
        ]);
    }

    public static function saveBesoin() {
        $ville = $_POST['ville'];
        $cat = $_POST['cat'];
        $nom = $_POST['nom'];
        $quantite = $_POST['quantite'];

        echo "<div class='alert alert-success text-center mt-3'>
                Le besoin '$nom' a été ajouté avec succès !
              </div>";
    }
}
