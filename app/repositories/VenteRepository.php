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

    public function create() {}

}