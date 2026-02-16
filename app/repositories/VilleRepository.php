<?php

    class VilleRepository {
        private $pdo;
        public function __construct(PDO $pdo) { $this->pdo = $pdo; }

        public function create($nom) {
            $sql = "INSERT INTO ville(nom) VALUES(?)";
            $st = $this->pdo->prepare($sql);
            try {
                $st->execute([ (string)$nom ]);
            } catch (PDOException $e) {
                // Ajoute des infos utiles pour le debug
                $info = $st->errorInfo();
                throw new RuntimeException('CREATE : DB error in create(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            return $this->pdo->lastInsertId();
        }

        public function findAll() {
            $sql = "SELECT * FROM ville";
            $st = $this->pdo->prepare($sql);
            try {
                $st->execute();
            } catch (PDOException $e) {
                $info = $st->errorInfo();
                throw new RuntimeException('FINDALL : DB error in findAll(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            
            return $st->fetchAll() ?? [];
        }

        public function findVilleWithFond() {
            $sql = "SELECT * FROM ville WHERE fond > 0";
            $st = $this->pdo->prepare($sql);
            try {
                $st->execute();
            } catch (PDOException $e) {
                $info = $st->errorInfo();
                throw new RuntimeException('FINDVILLEWITHFOND : DB error in findVilleWithFond(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            
            return $st->fetchAll() ?? [];
        }

        public function findById($idVille) {
            $sql = "SELECT * FROM ville WHERE id = ?";
            $st = $this->pdo->prepare($sql);
            try {
                $st->execute([ (int)$idVille ]);
            } catch (PDOException $e) {
                $info = $st->errorInfo();
                throw new RuntimeException('FINDBYID : DB error in findById(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            
            return $st->fetch();
        }

        public function updateFond($idVille, $fond) {
            $sql = "UPDATE ville SET fond = fond + ? WHERE id = ?";
            $st = $this->pdo->prepare($sql);
            try {
                $st->execute([ (float)$fond, (int)$idVille ]);
            } catch (PDOException $e) {
                $info = $st->errorInfo();
                throw new RuntimeException('UPDATE : DB error in updateFond(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            return $st->rowCount();
        }
    }