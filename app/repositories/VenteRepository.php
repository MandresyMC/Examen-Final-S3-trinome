<?php

class VenteRepository {
    private $pdo;
    public function __construct(PDO $pdo) { $this->pdo = $pdo; }


    public function findVilleDons() {
        $sql = "
            select 
                d.*,
                v.nom as nomVille,
                sd.id AS idStock, 
                p.nom as nomProduit,
                p.prixUnitaire
            from dons d 
            join stockDons sd on sd.id = d.idStock
            join produit p on sd.idProduit = p.id
            join ville v on v.id = d.idVille
            WHERE p.prixUnitaire IS NOT NULL
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

    public function create($idDons, $idCommission, $prixVente) {
        $sql = "
            INSERT INTO vente (idDons, idCommission, prixVente)
            VALUES (?, ?, ?)
        ";
        $st = $this->pdo->prepare($sql);
            try {
                $st->execute([ (int)$idDons, (int)$idCommission, (float)$prixVente ]);
            } catch (PDOException $e) {
                $info = $st->errorInfo();
                throw new RuntimeException('CREATE : DB error in create(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            return $this->pdo->lastInsertId();
    }

}