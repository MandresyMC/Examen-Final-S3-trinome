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

            $success = null;
            if (isset(Flight::request()->query['success'])) {
                $success = Flight::request()->query['success'];
            }
            
            $error = null;
            if (isset(Flight::request()->query['error'])) {
                $error = Flight::request()->query['error'];
            }
            
            Flight::render("formulaire_achat", [
                'ville' => $ville,
                'allStocksDons' => $stocksDons,
                'error' => $error,
                'success' => $success
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
                $error = null;
                if (!$stock) {
                    $error = "Stock introuvable.";
                    Flight::redirect('/formulaire_achat?idVille=' . $idVille . '&error=' . urlencode($error));
                    exit;
                }

                if ($stock['quantiteFinale'] < $quantiteAchetee) {
                    $error = "Quantité achetée dépasse la quantité disponible.";
                    Flight::redirect('/formulaire_achat?idVille=' . $idVille . '&error=' . urlencode($error));
                    exit;
                }

                $quantiteFinale = $stock['quantiteFinale'] - $quantiteAchetee;
                $repoStockDons->updateQuantiteFinale($quantiteFinale, $idStock); // mettre à jour stock (qte finale)

                $prix = $quantiteAchetee * $stock['prixUnitaire'];
                if ($prix > $repoVille->findById($idVille)['fond']) {
                    $error = "Montant insuffisant pour cet achat.";
                    Flight::redirect('/formulaire_achat?idVille=' . $idVille . '&error=' . urlencode($error));
                    exit;
                }
                
                $idAchat = $repoAchat->create($idVille, $idStock, $quantiteAchetee, $prix); // creer achat

                $retour = $repoVille->updateFond($idVille, -$prix); // mettre à jour fond de la ville

                $pdo->commit();

                Flight::redirect('/formulaire_achat?idVille=' . $idVille . '&success=' . urlencode("Achat enregistré avec succès."));
            } catch (Exception $e) {
                if ($pdo->inTransaction()) {
                    $pdo->rollBack();
                }
                Flight::redirect('/formulaire_achat?idVille=' . $idVille . '&error=' . urlencode("Erreur lors de l'enregistrement de l'achat : " . $e->getMessage()));
            }
        }
    }