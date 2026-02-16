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
    }