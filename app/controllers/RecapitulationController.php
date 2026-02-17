<?php

    class RecapitulationController {

        public function getAll() {
            $pdo  = Flight::db();
            $repoBesoin = new BesoinRepository($pdo);
            $repoDons = new DonsRepository($pdo);
            
            $besoins = $repoBesoin->findAll();
            $dons = $repoDons->findAll();

            echo json_encode([
                "besoins" => $besoins,
                "dons" => $dons,
            ], JSON_PRETTY_PRINT);
            exit;
        }
    }