<?php

class AchatRepository {
    private $pdo;
    public function __construct(PDO $pdo) { $this->pdo = $pdo; }

    public function create($idVille, $idDons) {
        $sql = "INSERT INTO vente(idVille, idDons, commission) VALUES(?, ?, 10)";
        $st = $this->pdo->prepare($sql);
        try {
            $st->execute([ (int)$idVille, (int)$idStock, (float)$quantite, (float)$prix ]);
        } catch (PDOException $e) {
            $info = $st->errorInfo();
            throw new RuntimeException('CREATE : DB error in create(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
        }
        return $this->pdo->lastInsertId();
    }
}