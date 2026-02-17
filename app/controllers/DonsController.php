<?php

    class DonsController {

        public function showDons() {
            $pdo = Flight::db();
            $repoBesoin = new BesoinRepository($pdo);
            $besoins = $repoBesoin->findAllWithDons();

            Flight::render('dons', [
                'besoins' => $besoins
            ]);
        }

        public function showFormulaireDons() {
            $pdo = Flight::db();
            $repoStockDons = new StockDonsRepository($pdo);
            $repoBesoin = new BesoinRepository($pdo);
            $repoDons = new DonsRepository($pdo);

            $idBesoin = (int)(Flight::request()->query['idBesoin'] ?? 0);
            $besoin = $repoBesoin->findById($idBesoin);
            $stockDons = $repoStockDons->findByProduit($besoin['idProduit']);
            $dons = $repoDons->findByIdBesoin($idBesoin); // maka ny don rehetra mifandraiky amin'ny besoin
            $donRealise = 0;
            foreach ($dons as $don) {
                $donRealise += $don['quantiteDonnee'];
            }

            $success = null;
            $error = null;
            if (isset(Flight::request()->query['success'])) {
                $success = Flight::request()->query['success'];
            }
            if (isset(Flight::request()->query['error'])) {
                $error = Flight::request()->query['error'];
            }

            Flight::render('formulaire_dons', [
                'besoin' => $besoin,
                'stockDons' => $stockDons,
                'success' => $success,
                'error' => $error,
                'donRealise' => $donRealise
            ]);
        }

        public function createDon() {
            $pdo = Flight::db();
            $repoDons = new DonsRepository($pdo);
            $repoStockDons = new StockDonsRepository($pdo);
            $repoAchat = new AchatRepository($pdo);
            $repoVille = new VilleRepository($pdo);

            $idVille = (int)(Flight::request()->data['idVille'] ?? 0);
            $idStock = (int)(Flight::request()->data['idStock'] ?? 0);
            $idBesoin = (int)(Flight::request()->data['idBesoin'] ?? 0);
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
                $repoStockDons->updateQuantiteFinale($quantiteFinale, $idStock); // mettre à jour stock (qte finale)

                $idDon = $repoDons->create($idVille, $idStock, $idBesoin, $quantiteDonnee); // creer don

                if ($stock['nomProduit'] == 'Argent') {
                    $retour = $repoVille->updateFond($idVille, $quantiteDonnee); // mettre à jour fond de la ville
                }

                $pdo->commit();
                Flight::redirect('/formulaire_dons?idBesoin=' . $idBesoin . '&success=Don créé avec succès');
                exit;

            } catch (Exception $e) {
                $pdo->rollBack();
                Flight::redirect('/formulaire_dons?idBesoin=' . $idBesoin . '&error=' . urlencode($e->getMessage()));
                exit;
            }
        }
    }