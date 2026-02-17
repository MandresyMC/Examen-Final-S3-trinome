<?php

    class BesoinRepository {
        private $pdo;
        public function __construct(PDO $pdo) { $this->pdo = $pdo; }

        public function create($idCategorie, $ville_id, $idProduit, $quantiteDemandee) {
            $sql = "INSERT INTO besoin(idCategorie, idVille, idProduit, quantiteDemandee) VALUES(?, ?, ?, ?)";
            $st = $this->pdo->prepare($sql);
            try {
                $st->execute([ (int)$idCategorie, (int)$ville_id, (int)$idProduit, (float)$quantiteDemandee ]);
            } catch (PDOException $e) {
                // Ajoute des infos utiles pour le debug
                $info = $st->errorInfo();
                throw new RuntimeException('CREATE : DB error in create(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            return $this->pdo->lastInsertId();
        }

        public function findAll() {
            $sql = "
                SELECT b.*, p.prixUnitaire, p.nom AS nomProduit, v.nom AS nomVille, v.id AS idVille
                FROM besoin b JOIN produit p ON b.idProduit = p.id JOIN ville v ON b.idVille = v.id
            ";
            $st = $this->pdo->prepare($sql);
            try {
                $st->execute();
            } catch (PDOException $e) {
                $info = $st->errorInfo();
                throw new RuntimeException('FINDALL : DB error in findAll(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            
            return $st->fetchAll() ?? [];
        }

        public function findById($id) {
            $sql = "
                SELECT b.*, p.prixUnitaire, p.nom AS nomProduit, v.nom AS nomVille, v.id AS idVille
                FROM besoin b JOIN produit p ON b.idProduit = p.id JOIN ville v ON b.idVille = v.id
                WHERE b.id = ?
            ";
            $st = $this->pdo->prepare($sql);
            try {
                $st->execute([ (int)$id ]);
            } catch (PDOException $e) {
                $info = $st->errorInfo();
                throw new RuntimeException('FINDBYID : DB error in findAll(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            
            return $st->fetch() ?? null;
        }

        public function findByVille($idVille) {
            $sql = "SELECT b.*, p.prixUnitaire, p.nom AS nomProduit, v.nom AS nomVille, v.id AS idVille FROM besoin b JOIN produit p ON b.idProduit = p.id JOIN ville v ON b.idVille = v.id WHERE b.idVille = ?";
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