<?php
class StockController {

    public static function showFormulaireStock() {
        $categories = [
            ['id' => 1, 'nom' => 'Alimentation'],
            ['id' => 2, 'nom' => 'Boissons'],
            ['id' => 3, 'nom' => 'Produits ménagers']
        ];

        Flight::render('formulaire_stock', ['categories' => $categories]);
    }

    public static function saveStock() {
        $cat = $_POST['cat'];
        $nom = $_POST['nom'];
        $quantite_initiale = $_POST['quantite_initiale'];
        $quantite_finale = $_POST['quantite_finale'];

        // Ici tu peux insérer les données dans la base
        // Exemple : INSERT INTO stock (cat_id, nom, qte_init, qte_final) VALUES (...)

        echo "<div class='alert alert-success text-center mt-3'>
                Le produit '$nom' a été ajouté au stock avec succès !
              </div>";
    }
}
