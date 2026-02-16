<?php
    class EchangeController {

        public function showEchange() {
            $pdo  = Flight::db();
            $repo = new ObjetRepository($pdo);

            $current_user = $_SESSION['current_user'];
            $idObjet = Flight::request()->query['idObjet'];
            $objetChoisi = $repo->getById($idObjet);
            
            $allObjets = $repo->findAll();

            $success = null;
            if (isset(Flight::request()->query['success'])) {
                $success = Flight::request()->query['success'];
            }

            Flight::render("echange", [
                'current_user' => $current_user,
                'objetChoisi' => $objetChoisi,
                'allObjets' => $allObjets,
                'success' => $success,
            ]);
        }

        public function createEchange() {
            $pdo  = Flight::db();
            $repo = new EchangeRepository($pdo);

            $idObjet1 = Flight::request()->query['idObjet1'];
            $idObjet2 = Flight::request()->query['idObjet2'];

            try {
                $id = $repo->create($idObjet1, $idObjet2);
            } catch (Exception $e) {
                Flight::render("echange", [
                    'error' => $e->getMessage(),
                ]);
                return;
            }

            Flight::redirect("/echange?idObjet=" . $idObjet1 . "&success=Invitation envoyée");
        }
    }