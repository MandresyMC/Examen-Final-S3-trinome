<?php

    class DonsController {

        public function showFormulaireDons() {
            $pdo = Flight::db();
            $repoVille = new VilleRepository($pdo);
            $repoStockDons = new StockDonsRepository($pdo);

            $villes = $repoVille->findAll();
            $stocksDons = $repoStockDons->findAll();

            Flight::render('formulaire_dons', [
                'villes' => $villes,
                'stocksDons' => $stocksDons
            ]);
        }
    }