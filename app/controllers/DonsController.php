<?php

    class DonsController {

        public function showFormulaireDons() {
            $pdo = Flight::db();
            $repoVille = new VilleRepository($pdo);
            $repoStockDons = new StockDonsRepository($pdo);

            $villes = $repoVille->findAll();
            $stocksDons = $repoStockDons->findAll();

            $success = null;
            $error = null;
            if (isset(Flight::request()->query['success'])) {
                $success = Flight::request()->query['success'];
            }
            if (isset(Flight::request()->query['error'])) {
                $error = Flight::request()->query['error'];
            }

            Flight::render('formulaire_dons', [
                'villes' => $villes,
                'stocksDons' => $stocksDons,
                'success' => $success,
                'error' => $error
            ]);
        }

        public function createDon() {
            $pdo = Flight::db();
            $repoDons = new DonsRepository($pdo);
            $repoStockDons = new StockDonsRepository($pdo);

            $idVille = Flight::request()->data['idVille'] ?? null;
            $idStock = Flight::request()->data['idStock'] ?? null;
            $quantiteDonnee = Flight::request()->data['quantiteDonnee'] ?? null;

            $stock = $repoStockDons->findById($idStock);
            $quantiteFinale = 0;
            $error = null;
            if (!$stock) {
                if ($stock['quantiteFinale'] < $quantiteDonnee) {
                    $error = "Quantité donnée dépasse la quantité finale disponible.";

                    Flight::redirect('/formulaire_dons?&error=' . $error);
                }
                $quantiteFinale = $stock['quantiteFinale'] - $quantiteDonnee;
                $repoStockDons->updateQuantiteFinale($quantiteFinale, $idStock);
            }

            $success = null;
            try {
                $id = $repoDons->create($idVille, $idStock, $quantiteDonnee);
                $success = "Don créé avec succès";
            } catch (Exception $e) {
                $error = $e->getMessage();
            }

            Flight::redirect('/formulaire_dons?success=' . $success . '&error=' . $error);
        }
    }