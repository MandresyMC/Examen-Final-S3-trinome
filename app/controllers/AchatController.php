<?php

    class AchatController {

        public function showVilleAchat() {
            $pdo  = Flight::db();
            $repo = new VilleRepository($pdo);

            $villes = $repo->findVilleWithFond();

            Flight::render("achat", [
                'allVilles' => $villes
            ]);
        }
    
        public function showFormulaireAchat() {
            $pdo  = Flight::db();
            $repoVille = new VilleRepository($pdo);
            $repoStockDons = new StockDonsRepository($pdo);

            $idVille = (int)(Flight::request()->query['idVille'] ?? 0);
            
            $ville = $repoVille->findById($idVille);
            $stocksDons = $repoStockDons->findAll();

            Flight::render("formulaire_achat", [
                'ville' => $ville,
                'allStocksDons' => $stocksDons
            ]);
        }

        public function saveAchat() {
            $pdo = Flight::db();
            $repoAchat = new AchatRepository($pdo);
            $repoStockDons = new StockDonsRepository($pdo);
            $repoVille = new VilleRepository($pdo);

            $idVille = (int)(Flight::request()->data['idVille'] ?? 0);
            $idStock = (int)(Flight::request()->data['idStock'] ?? 0);
            $quantiteAchetee = (float)(Flight::request()->data['quantiteAchetee'] ?? 0);

            try {
                $pdo->beginTransaction();

                $stock = $repoStockDons->findById($idStock);
                if (!$stock) {
                    throw new Exception("Stock introuvable.");
                }

                if ($stock['quantiteFinale'] < $quantiteAchetee) {
                    throw new Exception("Quantité achetée dépasse la quantité disponible.");
                }

                $quantiteFinale = $stock['quantiteFinale'] - $quantiteAchetee;
                $repoStockDons->updateQuantiteFinale($quantiteFinale, $idStock); // mettre à jour stock (qte finale)

                $idAchat = $repoAchat->create($idVille, $idStock, null, $quantiteAchetee); // creer achat

                if ($stock['nomProduit'] == 'Argent') {
                    $retour = $repoVille->updateFond($idVille, -$quantiteAchetee); // mettre à jour fond de la ville
                }

                $pdo->commit();

                Flight::redirect('/achat?success=' . urlencode("Achat enregistré avec succès."));
            } catch (Exception $e) {
                if ($pdo->inTransaction()) {
                    $pdo->rollBack();
                }
                Flight::redirect('/achat?error=' . urlencode("Erreur lors de l'enregistrement de l'achat : " . $e->getMessage()));
            }
        }
    }