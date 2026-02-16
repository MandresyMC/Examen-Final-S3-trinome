<?php

    class StockDonsRepository {
        private $pdo;
        public function __construct(PDO $pdo) { $this->pdo = $pdo; }

        public function create($idCategorie, $idProduit, $quantiteInitiale, $quantiteFinale) {
            $sql = "INSERT INTO stockDons(idCategorie, idProduit, quantiteInitiale, quantiteFinale) VALUES(?, ?, ?, ?)";
            $st = $this->pdo->prepare($sql);
            try {
                $st->execute([ (int)$idCategorie, (int)$idProduit, (float)$quantiteInitiale, (float)$quantiteFinale ]);
            } catch (PDOException $e) {
                // Ajoute des infos utiles pour le debug
                $info = $st->errorInfo();
                throw new RuntimeException('CREATE : DB error in create(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            return $this->pdo->lastInsertId();
        }

        public function updateQuantiteFinale($quantiteFinale, $idStock) {
            $sql = "UPDATE stockDons SET quantiteFinale = ? WHERE id = ?";
            $st = $this->pdo->prepare($sql);
            try {
                $st->execute([ (float)$quantiteFinale, (int)$idStock ]);
            } catch (PDOException $e) {
                // Ajoute des infos utiles pour le debug
                $info = $st->errorInfo();
                throw new RuntimeException('UPDATE : DB error in updateQuantiteFinale(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            return $st->rowCount();
        }

        public function findAll() {
            $sql = "SELECT sd.*, p.nom AS nomProduit, p.prixUnitaire AS prixUnitaire FROM stockDons sd JOIN produit p ON sd.idProduit = p.id";
            $st = $this->pdo->prepare($sql);
            try {
                $st->execute();
            } catch (PDOException $e) {
                $info = $st->errorInfo();
                throw new RuntimeException('FINDALL : DB error in findAll(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            
            return $st->fetchAll() ?? [];
        }

        public function findById($idStock) {
            $sql = "SELECT sd.*, p.nom AS nomProduit FROM stockDons sd JOIN produit p ON sd.idProduit = p.id WHERE sd.id = ?";
            $st = $this->pdo->prepare($sql);
            try {
                $st->execute([ (int)$idStock ]);
            } catch (PDOException $e) {
                $info = $st->errorInfo();
                throw new RuntimeException('FINDBYID : DB error in findById(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            
            return $st->fetch();
        }
    }