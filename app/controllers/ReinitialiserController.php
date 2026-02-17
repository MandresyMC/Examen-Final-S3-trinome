<?php

    class ReinitialiserController {

        public function reinitialiser() {
            $pdo  = Flight::db();
            $repo = new ReinitialiserRepository($pdo);
            
            $repo->reinitialiser();

            Flight::render("reinitialiser", [
                'success' => "Données réinitialisées avec succès.",
            ]);
        }

    }