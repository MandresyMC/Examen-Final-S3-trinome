<?php

    class ReinitialiserController {

        public function showReinitialiser() {
            $success = null;
            if (isset(Flight::request()->query['success'])) {
                $success = Flight::request()->query['success'];
            }
            Flight::render("reinitialiser", ['success' => $success]);
        }

        public function reinitialiser() {
            $pdo  = Flight::db();
            $repo = new ReinitialiserRepository($pdo);
            
            $repo->reinitialiser();

            Flight::render("reinitialiser", [
                'success' => "Données réinitialisées avec succès.",
            ]);
        }

    }