<?php
    class DashboardController {

        public function showDashboar() {
            $pdo  = Flight::db();
            $repo = new DashboardRepository($pdo);
            
            $besoin = $repo->findDashboardBesoin();
            $achat = $repo->findDashboard();

            $success = null;
            if (isset(Flight::request()->query['success'])) {
                $success = Flight::request()->query['success'];
            }

            Flight::render("dashboard", [
                'besoin' => $besoin,
                'achat' => $besoin,
            ]);
        }

    }

?>