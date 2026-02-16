<?php
    class DashboardController {

        public function showDashboard() {
            $pdo  = Flight::db();
            $repo = new DashboardRepository($pdo);
            
            $allObjets = $repo->findAllDashboard();

            $success = null;
            if (isset(Flight::request()->query['success'])) {
                $success = Flight::request()->query['success'];
            }

            Flight::render("dashboard", [
                'allObjets' => $allObjets,
            ]);
        }
    }

?>