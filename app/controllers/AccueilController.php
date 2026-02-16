<?php
    class AccueilController {

        public function showAccueil() {
            $pdo  = Flight::db();
            $repo = new UserRepository($pdo);
            $repoObjet = new ObjetRepository($pdo);

            $current_user = $_SESSION['current_user'];
            
            try {
                $user_nom = $repo->getNomById($current_user);
                $_SESSION['nom'] = $user_nom;
                
                $objets = $repoObjet->findAll();
                
                Flight::render('accueil', [
                    'current_user' => $current_user,
                    'user_nom' => $user_nom,
                    'objets' => $objets,
                ]);
            } catch (Exception $e) {
                Flight::render('accueil', [
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }