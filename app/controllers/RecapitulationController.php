<?php

    class RecapitulationController {

        public function getAll() {
            $pdo  = Flight::db();
            $repo = new BesoinRepository($pdo);
            
            $besoins = $repo->findAll();

            Flight::json($besoins);
        }
    }