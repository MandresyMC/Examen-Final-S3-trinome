<?php

    class DashboardRepository {
        private $pdo;
        public function __construct(PDO $pdo) { $this->pdo = $pdo; }

        public function findDashboard() {
            $sql = "
                SELECT b.idCategorie, b.quantiteDemandee, b.nomProduit, b.idVille, d.quantiteDonnee 
                FROM besoin b join dons d on b.idVille = d.idVille
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