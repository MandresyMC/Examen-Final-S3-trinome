<?php

    class DonRepository {
        private $pdo;
        public function __construct(PDO $pdo) { $this->pdo = $pdo; }

        public function create($idBesoin, $quantite) {
            $sql = "INSERT INTO don(idBesoin, quantite) VALUES(?, ?)";
            $st = $this->pdo->prepare($sql);
            try {
                $st->execute([ (int)$idBesoin, (int)$quantite ]);
            } catch (PDOException $e) {
                // Ajoute des infos utiles pour le debug
                $info = $st->errorInfo();
                throw new RuntimeException('CREATE : DB error in create(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            return $this->pdo->lastInsertId();
        }

        public function findAll() {
            $sql = "SELECT * FROM don";
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