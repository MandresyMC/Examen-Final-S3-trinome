<?php
    class ObjetRepository {
        private $pdo;
        public function __construct(PDO $pdo) { $this->pdo = $pdo; }

        public function findAll() {
            $st = $this->pdo->prepare("SELECT * FROM objets");
            try {
                $st->execute();
            } catch (PDOException $e) {
                $info = $st->errorInfo();
                throw new RuntimeException('FINDALL : DB error in verifyLogin(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            
            $objets = $st->fetchAll();
            
            return $objets ?? [];
        }

        public function getById($id) {
            $st = $this->pdo->prepare("SELECT * FROM objets WHERE id = ?");
            try {
                $st->execute([ (int)$id ]);
            } catch (PDOException $e) {
                $info = $st->errorInfo();
                throw new RuntimeException('FINDALL : DB error in verifyLogin(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            
            $objet = $st->fetch();
            
            return $objet ?? false;
        }

        public function exchangeIdUser($donneeEchange) {
            $sql1 = "UPDATE objets SET idUser = :idUser2 WHERE id = :idObjet1";
            $sql2 = "UPDATE objets SET idUser = :idUser1 WHERE id = :idObjet2";
            $st1 = $this->pdo->prepare($sql1);
            $st2 = $this->pdo->prepare($sql2);
            try {
                $this->pdo->beginTransaction();
                $st1->execute([
                    ':idUser2' => $donneeEchange['objet2_idUser'],
                    ':idObjet1' => $donneeEchange['idObjet1']
                ]);
                $st2->execute([
                    ':idUser1' => $donneeEchange['objet1_idUser'],
                    ':idObjet2' => $donneeEchange['idObjet2']
                ]);
                $this->pdo->commit();
            } catch (PDOException $e) {
                $this->pdo->rollback();
                throw new RuntimeException('EXCHANGEIDUSER : DB error in exchangeIdUser(): ' . $e->getMessage());
            }
        }
    }