<?php

    class BesoinRepository {
        private $pdo;
        public function __construct(PDO $pdo) { $this->pdo = $pdo; }

        public function create($idCategorie, $ville_id, $nom, $quantite) {
            $sql = "INSERT INTO besoin(idCategorie, idVille, nom, quantite) VALUES(?, ?, ?, ?)";
            $st = $this->pdo->prepare($sql);
            try {
                $st->execute([ (int)$idCategorie, (int)$ville_id, (string)$nom, (int)$quantite ]);
            } catch (PDOException $e) {
                // Ajoute des infos utiles pour le debug
                $info = $st->errorInfo();
                throw new RuntimeException('CREATE : DB error in create(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            return $this->pdo->lastInsertId();
        }

        public function findAll() {
            $sql = "SELECT * FROM besoin";
            $st = $this->pdo->prepare($sql);
            try {
                $st->execute();
            } catch (PDOException $e) {
                $info = $st->errorInfo();
                throw new RuntimeException('FINDALL : DB error in findAll(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            
            return $st->fetchAll();
        }

        public function findByVille($idVille) {
            $sql = "SELECT * FROM besoin WHERE idVille = ?";
            $st = $this->pdo->prepare($sql);
            try {
                $st->execute([ (int)$idVille ]);
            } catch (PDOException $e) {
                $info = $st->errorInfo();
                throw new RuntimeException('FINDBYVILLE : DB error in findByVille(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            
            return $st->fetchAll();
        }
    }