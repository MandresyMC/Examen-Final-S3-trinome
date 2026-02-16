<?php

    class RecapitulationController {

        public function showRecapitulation() {
            $pdo  = Flight::db();
            $repo = new BesoinRepository($pdo);
            
            $besoins = $repo->findAll();

            Flight::render("recapitulation", [
                'besoins' => $besoins,
            ]);
        }
    }