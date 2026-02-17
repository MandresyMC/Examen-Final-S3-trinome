<?php

class AchatRepository {
    private $pdo;
    public function __construct(PDO $pdo) { $this->pdo = $pdo; }

    public function create($idVille, $idDons, $commission, $prixProduit) {
        $sql = "INSERT INTO vente(idVille, idDons, commission, prixVente) VALUES(?, ?, ?)";
        $st = $this->pdo->prepare($sql);

        $commission = 10 ;
        $prixVente = (float)$prixProduit - ((float)$prixProduit * (float)$commission / 100);
        
        try {
            $st->execute([ (int)$idVille, (int)$idDons, (float)$commission, (float)$prixVente ]);
        } catch (PDOException $e) {
            $info = $st->errorInfo();
            throw new RuntimeException('CREATE : DB error in create(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
        }
        return $this->pdo->lastInsertId();
    }
}