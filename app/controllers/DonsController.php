<?php

    class DonsController {

        public function showFormulaireDons() {
            $pdo = Flight::db();
            $repoVille = new VilleRepository($pdo);
            $repoStockDons = new StockDonsRepository($pdo);

            $villes = $repoVille->findAll();
            $stocksDons = $repoStockDons->findAll();

            $success = null;
            if (isset(Flight::request()->query['success'])) {
                $success = Flight::request()->query['success'];
            }

            Flight::render('formulaire_dons', [
                'villes' => $villes,
                'stocksDons' => $stocksDons,
                'success' => $success
            ]);
        }

        public function createDon() {
            $pdo = Flight::db();
            $repoDons = new DonsRepository($pdo);

            $idVille = Flight::request()->data['idVille'] ?? null;
            $idStock = Flight::request()->data['idStock'] ?? null;
            $quantiteDonnee = Flight::request()->data['quantiteDonnee'] ?? null;

            $success = null;
            try {
                $id = $repoDons->create($idVille, $idStock, $quantiteDonnee);
                $success = "Don créé avec succès";
            } catch (Exception $e) {
                $success = $e->getMessage();
            }

            Flight::redirect('/formulaire_dons?success=' . $success);
        }
    }