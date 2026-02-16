<?php
class CategorieRepository {
    private $pdo;
    public function __construct(PDO $pdo) { $this->pdo = $pdo; }

    public function findAll() {
        $sql = "SELECT * FROM categorie ORDER BY nom";
        $st = $this->pdo->prepare($sql);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC) ?? [];
    }
}
