<?php

class CommissionController {

    public function showFormulaireCommission() {
        $pdo = Flight::db();
        $repoCommission = new CommissionRepository($pdo);

        $commission = $repoCommission->findAll();

        $success = null;
        $error = null;
        if (isset(Flight::request()->query['success'])) {
            $success = Flight::request()->query['success'];
        }
        if (isset(Flight::request()->query['error'])) {
            $error = Flight::request()->query['error'];
        }

        Flight::render('formulaire_commission', [
            'commission' => $commission,
            'success' => $success,
            'error' => $error
        ]);
    }

    public function updateCommission() {
        $pdo = Flight::db();
        $repoCommission = new CommissionRepository($pdo);

        $id = (int)(Flight::request()->data['id'] ?? 0);
        $pourcentage = (float)(Flight::request()->data['pourcentage'] ?? 0);

        try {
            if ($id > 0) {
                $repoCommission->update($id, $pourcentage);
                Flight::redirect('/commission?success=' . urlencode('Commission mise à jour avec succès'));
            } else {
                $repoCommission->create($pourcentage);
                Flight::redirect('/commission?success=' . urlencode('Commission créée avec succès'));
            }
        } catch (Exception $e) {
            Flight::redirect('/commission?error=' . urlencode($e->getMessage()));
        }
    }
}
