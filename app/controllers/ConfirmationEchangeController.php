<?php
    class ConfirmationEchangeController {
        
        public function showConfirmationEchange() {
            $pdo  = Flight::db();
            $repo = new EchangeRepository($pdo);

            $current_user = $_SESSION['current_user'];
            
            $allConfirmEchange = $repo->findAllByIdUser($current_user);

            $success = null;
            if (isset(Flight::request()->query['success'])) {
                $success = Flight::request()->query['success'];
            }

            Flight::render("confirmation_echange", [
                'current_user' => $current_user,
                'success' => $success,
                'allConfirmEchange' => $allConfirmEchange,
            ]);
        }

        public function declineEchange() {
            $pdo  = Flight::db();
            $repo = new EchangeRepository($pdo);

            $current_user = $_SESSION['current_user'];
            $idEchange = Flight::request()->query['idEchange'];
            
            $retour = $repo->declineEchange($idEchange);
            $success = null;
            if ($retour) {
                $success = "Echange decliné avec succès !";
            }
            
            Flight::redirect("/confirmation_echange?success=" . $success);
        }

        public function acceptEchange() {
            $pdo  = Flight::db();
            $repo = new EchangeRepository($pdo);
            $repoObjet = new ObjetRepository($pdo);

            $current_user = $_SESSION['current_user'];
            $idEchange = Flight::request()->query['idEchange'];
            $donneEchange = $repo->findById($idEchange);
            $repoObjet->exchangeIdUser($donneEchange); // mamadika ny idUser an'ny objet1 sy objet2

            $retour = $repo->acceptEchange($idEchange);
            $retourCancel = $repo->cancelOtherEchange($idEchange, $donneEchange['idObjet1'], $donneEchange['idObjet2']);

            
            $success = null;
            if ($retour && $retourCancel) {
                $success = "Echange accepté avec succès !";
            }
            
            Flight::redirect("/confirmation_echange?success=" . $success);
        }
    }