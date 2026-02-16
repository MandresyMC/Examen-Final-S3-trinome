<?php

    class StockDonsRepository {
        private $pdo;
        public function __construct(PDO $pdo) { $this->pdo = $pdo; }

        public function findAll() {
            $sql = "SELECT * FROM achats";
            $st = $this->pdo->prepare($sql);
            try {
                $st->execute();
            } catch (PDOException $e) {
                $info = $st->errorInfo();
                throw new RuntimeException('FINDALL : DB error in findAll(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            
            return $st->fetchAll() ?? [];
        }

        public function findById($idVille) {
            $sql = "SELECT * FROM achats WHERE idVille = ?";
            $st = $this->pdo->prepare($sql);
            try {
                $st->execute([ (int)$idStock ]);
            } catch (PDOException $e) {
                $info = $st->errorInfo();
                throw new RuntimeException('FINDBYID : DB error in findById(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            
            return $st->fetch();
        }

       /*
        public function getTotalAchat($idVille) {
            $prixtotal = 
        }
        */
    }