<?php

    class DashboardRepository {
        private $pdo;
        public function __construct(PDO $pdo) { $this->pdo = $pdo; }

        public function findDashboardBesoin() {
            $sql = "
                SELECT
                b.idCategorie AS idCat,
                v.nom AS villeNom,
                p.nom AS nomProduit,
                b.quantiteDemandee AS quantiteDemandee,
                COALESCE(SUM(d.quantiteDonnee), 0) AS totalDonne
                FROM besoin b
                JOIN produit p ON b.idProduit = p.nom
                JOIN ville v ON b.idVille = v.id
                LEFT JOIN dons d 
                ON d.idVille = b.idVille
                GROUP BY b.id, v.nom, p.nom, b.quantiteDemandee, b.idCategorie;
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

        public function findDashboardAchat() {
            $sql = "
                SELECT
                    v.nom AS villeNom,
                    p.nom AS nomProduit,
                    a.quantite AS quantiteAchetee,
                    a.prix AS prixAchat,
                    sd.quantiteInitiale,
                    sd.quantiteFinale,
                    a.created_at As dateAchat
                FROM achat a
                JOIN ville v ON a.idVille = v.id
                JOIN stockDons sd ON a.idStock = sd.id
                JOIN produit p ON sd.idProduit = p.id;
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

            public function findDashboardVente() {
                $sql = "
                    SELECT
                    vi.nom AS villeNom,
                    p.nom AS nomProduit,
                    ve.prixVente AS prixVente
                    FROM vente ve
                    JOIN dons d ON ve.idDons = d.id
                    JOIN ville vi ON d.idVille = vi.id
                    JOIN stockDons sd ON d.idStock = sd.id
                    JOIN produit p ON sd.idProduit = p.id;
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
    }

?>