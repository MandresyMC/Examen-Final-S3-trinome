<?php

class CommissionRepository {
    private $pdo;
    public function __construct(PDO $pdo) { $this->pdo = $pdo; }

    public function create($pourcentage) {
        $sql = "INSERT INTO commission(pourcentage) VALUES(?)";
        $st = $this->pdo->prepare($sql);
        try {
            $st->execute([ (float)$pourcentage ]);
        } catch (PDOException $e) {
            $info = $st->errorInfo();
            throw new RuntimeException('CREATE : DB error in create(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
        }
        return $this->pdo->lastInsertId();
    }

    public function findAll() {
        $sql = "SELECT * FROM commission LIMIT 1";
        $st = $this->pdo->prepare($sql);
        try {
            $st->execute();
        } catch (PDOException $e) {
            $info = $st->errorInfo();
            throw new RuntimeException('FINDALL : DB error in findAll(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
        }
        
        return $st->fetch() ?? null;
    }

    public function update($id, $pourcentage) {
        $sql = "UPDATE commission SET pourcentage = ? WHERE id = ?";
        $st = $this->pdo->prepare($sql);
        try {
            $st->execute([ (float)$pourcentage, (int)$id ]);
        } catch (PDOException $e) {
            $info = $st->errorInfo();
            throw new RuntimeException('UPDATE : DB error in update(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
        }
        return $st->rowCount();
    }
}
