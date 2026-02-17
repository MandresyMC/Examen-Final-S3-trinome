<?php

    class DonsRepository {
        private $pdo;
        public function __construct(PDO $pdo) { $this->pdo = $pdo; }

        public function create($idVille, $idStock, $idBesoin, $quantiteDonnee) {
            $sql = "INSERT INTO dons(idVille, idStock, idBesoin, quantiteDonnee) VALUES(?, ?, ?, ?)";
            $st = $this->pdo->prepare($sql);
            try {
                $st->execute([ (int)$idVille, (int)$idStock, (int)$idBesoin, (float)$quantiteDonnee ]);
            } catch (PDOException $e) {
                // Ajoute des infos utiles pour le debug
                $info = $st->errorInfo();
                throw new RuntimeException('CREATE : DB error in create(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            return $this->pdo->lastInsertId();
        }

        public function findAll() {
            $sql = "
                SELECT 
                    d.*,
                    v.nom AS nomVille,
                    p.nom AS nomProduit,
                    p.prixUnitaire
                FROM dons d
                JOIN ville v ON d.idVille = v.id
                JOIN stockDons s ON d.idStock = s.id
                JOIN produit p ON s.idProduit = p.id
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
        
        public function findById($id) {
            $sql = "
                SELECT 
                    d.*,
                    v.nom AS nomVille,
                    p.nom AS nomProduit,
                    p.prixUnitaire
                FROM dons d
                JOIN ville v ON d.idVille = v.id
                JOIN stockDons s ON d.idStock = s.id
                JOIN produit p ON s.idProduit = p.id
                WHERE d.id = ?
            ";
            $st = $this->pdo->prepare($sql);
            try {
                $st->execute([ (int)$id ]);
            } catch (PDOException $e) {
                $info = $st->errorInfo();
                throw new RuntimeException('FINDBYID : DB error in findById(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            
            return $st->fetch();
        }
    }