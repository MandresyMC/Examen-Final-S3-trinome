<?php

class ProduitRepository {
    private $pdo;
    public function __construct(PDO $pdo) { $this->pdo = $pdo; }

    public function findAll() {
        $sql = "SELECT * FROM produit ORDER BY nom";
        $st = $this->pdo->prepare($sql);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC) ?? [];
    }

    public function findById($id) {
        $sql = "SELECT * FROM produit WHERE id = ?";
        $st = $this->pdo->prepare($sql);
        $st->execute([ (int)$id ]);
        return $st->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function addProduit($nom, $prixUnitaire, $idCategorie) {
        $sql = "INSERT INTO produit (nom, prixUnitaire,idCategorie) VALUES (?, ?, ?)";
        $st = $this->pdo->prepare($sql);
        try {
            $st->execute([ $nom, (float)$prixUnitaire, (int)$idCategorie ]);
        } catch (PDOException $e) {
            $info = $st->errorInfo();
            throw new RuntimeException('CREATE : DB error in create(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
        }
        return $this->pdo->lastInsertId();
    }
}
