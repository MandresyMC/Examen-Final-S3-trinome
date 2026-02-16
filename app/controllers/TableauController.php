<?php

class TableauController {

    public static function showAchats() {
        $pdo = Flight::db();
        $repoAchat = new TableauRepository($pdo);

        try {
            $achats = $repoAchat->findAll();
        } catch (RuntimeException $e) {
            $achats = []; // éviter le crash côté vue
        }

        Flight::render('tableau', [
            'achats' => $achats
        ]);
    }
}
