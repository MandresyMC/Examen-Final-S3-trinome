<?php

class ReinitialiserRepository {
    private $pdo;
    public function __construct(PDO $pdo) { $this->pdo = $pdo; }

    public function reinitialiser() {
        $this->pdo->exec("TRUNCATE TABLE besoins");
        $this->pdo->exec("TRUNCATE TABLE stocks");
        $this->pdo->exec("TRUNCATE TABLE dons");
        $this->pdo->exec("TRUNCATE TABLE achats");
    }

}