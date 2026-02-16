<?php

class AchatRepository {
    private $pdo;
    public function __construct(PDO $pdo) { $this->pdo = $pdo; }

    public function create($idVille, $idStock, $idDon, $quantite, $prix) {
        $sql = "INSERT INTO achat(idVille, idStock, idDon, quantite, prix) VALUES(?, ?, ?, ?, ?)";
        $st = $this->pdo->prepare($sql);
        try {
            $st->execute([ (int)$idVille, (int)$idStock, (int)$idDon, (float)$quantite, (float)$prix ]);
        } catch (PDOException $e) {
            $info = $st->errorInfo();
            throw new RuntimeException('CREATE : DB error in create(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
        }
        return $this->pdo->lastInsertId();
    }
}
