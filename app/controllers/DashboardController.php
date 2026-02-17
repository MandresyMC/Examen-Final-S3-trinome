<?php
    class DashboardController {

        public function showDashboard() {
            $pdo  = Flight::db();
            $repo = new DashboardRepository($pdo);
            
            $besoin = $repo->findDashboardBesoin();
            $achat = $repo->findDashboardAchat();
            $vente = $repo->findDashboardVente();

            $success = null;
            if (isset(Flight::request()->query['success'])) {
                $success = Flight::request()->query['success'];
            }

            Flight::render("dashboard", [
                'besoin' => $besoin,
                'achat' => $achat,
                'vente' => $vente,
            ]);
        }

    }

?>


 