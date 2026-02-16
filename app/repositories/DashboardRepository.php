<?php

    class DashboardRepository {
        private $pdo;
        public function __construct(PDO $pdo) { $this->pdo = $pdo; }

        public function findDashboard() {
            $sql = "
                SELECT b.idCategorie AS idCat,
                       b.quantiteDemandee AS quantiteDemande,
                       p.nom AS nomProduit,
                       v.nom AS villeNom,
                       d.quantiteDonnee AS quantiteDonne,
                       a.prix AS achat,
                       a.created_at AS dateAchat
                FROM besoin b
                JOIN produit p ON b.idProduit = p.id
                JOIN ville v ON b.idVille = v.id
                JOIN dons d ON b.idVille = d.idVille
                JOIN achat a ON a.idVille = d.idVille
            ";
            $st = $this->pdo->prepare($sql);
            try {
                $st->execute();
            } catch (PDOException $e) {
                $info = $st->errorInfo();
                throw new RuntimeException('FINDALL : DB error in findAll(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            
            return $st->fetchAll();
        }
    }

?>