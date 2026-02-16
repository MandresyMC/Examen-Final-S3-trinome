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

            $idVille = (int)(Flight::request()->data['idVille'] ?? 0);
            $idStock = (int)(Flight::request()->data['idStock'] ?? 0);
            $quantiteDonnee = (float)(Flight::request()->data['quantiteDonnee'] ?? 0);

            try {
                $pdo->beginTransaction();

                $stock = $repoStockDons->findById($idStock);
                if (!$stock) {
                    throw new Exception("Stock introuvable.");
                }

                if ($stock['quantiteFinale'] < $quantiteDonnee) {
                    throw new Exception("Quantité donnée dépasse la quantité disponible.");
                }

                $quantiteFinale = $stock['quantiteFinale'] - $quantiteDonnee;
                $repoStockDons->updateQuantiteFinale($quantiteFinale, $idStock);

                $repoDons->create($idVille, $idStock, $quantiteDonnee);

                $pdo->commit();
                Flight::redirect('/formulaire_dons?success=Don créé avec succès');
                exit;

            } catch (Exception $e) {
                $pdo->rollBack();
                Flight::redirect('/formulaire_dons?error=' . urlencode($e->getMessage()));
                exit;
            }
        }
    }