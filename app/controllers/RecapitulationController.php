<?php

    class RecapitulationController {

        public function getAll() {
            $pdo  = Flight::db();
            $repoBesoin = new BesoinRepository($pdo);
            $repoDons = new DonsRepository($pdo);
            
            $besoins = $repoBesoin->findAll();
            $dons = $repoDons->findAll();

            Flight::json([
                "besoins" => $besoins,
                "dons" => $dons
            ]);
        }
    }