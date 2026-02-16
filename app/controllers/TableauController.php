<?php

class StockController {

    public static function showAchats() {
        $pdo = Flight::db();
        $repoAchat = new TableauRepository($pdo);

        $achats = $repoAchat->findAll();

        Flight::render('tableau_de_bord', [
            'achats' => $achats
        ]);
    }


}
