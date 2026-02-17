<?php

    class VenteController {

        public function showVilleDons() {
            $pdo  = Flight::db();
            $repoVente = new VenteRepository($pdo);
            
            $villeDons = $repoVente->findVilleDons();

            $success = null;
            if (isset(Flight::request()->query['success'])) {
                $success = Flight::request()->query['success'];
            }
            
            $error = null;
            if (isset(Flight::request()->query['error'])) {
                $error = Flight::request()->query['error'];
            }
            
            Flight::render("vente", [
                'villeDons' => $villeDons,
                'success' => $success,
                'error' => $error
            ]);
        }

        public function createVente() {
            $pdo  = Flight::db();
            $repoVente = new VenteRepository($pdo);
            $repoCommission = new CommissionRepository($pdo);
            $repoDons = new DonsRepository($pdo);
            $repoVille = new VilleRepository($pdo);

            $idDons = Flight::request()->data['idDons'] ?? null;

            try {
                $pdo->beginTransaction();
                $commission = $repoCommission->findAll();
                $don = $repoDons->findById($idDons);

                $prixUnitaire = $don['prixUnitaire'] ?? 1;
                $prixVente = $don['quantiteDonnee'] * $prixUnitaire * $commission['pourcentage'] / 100;

                $retour = $repoVente->create($idDons, $commission['id'], $prixVente);
                if (!$retour) {
                    throw new Exception("Erreur lors de la création de la vente.");
                }

                $retourVilleFond = $repoVille->updateFond($don['idVille'], $prixVente); // miampy ny volan'ny ville
                if (!$retourVilleFond) {
                    throw new Exception("Erreur lors de la mise à jour du fond de la ville.");
                }

                $pdo->commit();
                Flight::redirect('/vente?success=' . urlencode('Vente créée avec succès'));

            } catch (Exception $e) {
                $pdo->rollBack();
                Flight::redirect('/vente?error=' . urlencode($e->getMessage()));
            }
        }
    }