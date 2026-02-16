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
}
