<?php
    class EchangeRepository {
        private $pdo;
        public function __construct(PDO $pdo) { $this->pdo = $pdo; }

        public function create($idObjet1, $idObjet2) {
            $st = $this->pdo->prepare("
            INSERT INTO echange(idObjet1, idObjet2)
            VALUES(?, ?)
            ");
            try {
                $st->execute([ (int)$idObjet1, $idObjet2 ]);
            } catch (PDOException $e) {
                // Ajoute des infos utiles pour le debug
                $info = $st->errorInfo();
                throw new RuntimeException('CREATE_ECHANGE : DB error in create(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            return $this->pdo->lastInsertId();
        }

        public function findAllByIdUser($current_user) {
            $sql = "
                SELECT e.*,
                    o1.titre AS objet1_titre,
                    o2.titre AS objet2_titre,
                    o1.idUser AS objet1_idUser,
                    o2.idUser AS objet2_idUser
                FROM echange e
                JOIN objets o1 ON e.idObjet1 = o1.id
                JOIN objets o2 ON e.idObjet2 = o2.id
                WHERE o1.idUser = :idUser
                AND e.etat = 'en attente'
            ";
            $st = $this->pdo->prepare($sql);
            try {
                $st->execute([ ':idUser' => $current_user ]);
            } catch (PDOException $e) {
                $info = $st->errorInfo();
                throw new RuntimeException('FINDALLBYUSERID : DB error in verifyLogin(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            
            $objets = $st->fetchAll();
            
            return $objets ?? [];
        }

        public function findById($id) {
            $sql = "
                SELECT e.*,
                    o1.titre AS objet1_titre,
                    o2.titre AS objet2_titre,
                    o1.idUser AS objet1_idUser,
                    o2.idUser AS objet2_idUser
                FROM echange e
                JOIN objets o1 ON e.idObjet1 = o1.id
                JOIN objets o2 ON e.idObjet2 = o2.id
                WHERE e.id = :id
            ";
            $st = $this->pdo->prepare($sql);
            try {
                $st->execute([ ':id' => $id ]);
            } catch (PDOException $e) {
                $info = $st->errorInfo();
                throw new RuntimeException('FINDBYID : DB error in verifyLogin(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            
            $echange = $st->fetch();
            
            return $echange ?? false;
        }

        public function declineEchange($idEchange) {
            $sql = "UPDATE echange SET etat = 'decliner' WHERE id = :id";
            $st = $this->pdo->prepare($sql);
            try {
                $st->execute([ ':id' => $idEchange ]);
            } catch (PDOException $e) {
                $info = $st->errorInfo();
                throw new RuntimeException('DECLINEECHANGE : DB error in verifyLogin(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            return true;
        }

        public function acceptEchange($idEchange) {
            $sql = "UPDATE echange SET etat = 'accepter' WHERE id = :id";
            $st = $this->pdo->prepare($sql);
            try {
                $st->execute([ ':id' => $idEchange ]);
            } catch (PDOException $e) {
                $info = $st->errorInfo();
                throw new RuntimeException('ACCEPTECHANGE : DB error in verifyLogin(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            return true;
        }

        public function cancelOtherEchange($idEchange, $idObjet1, $idObjet2) {
            $sql = "
                UPDATE echange
                SET etat = 'annuler'
                WHERE id != :idEchange
                AND (
                    idObjet1 = :idObjet1 OR idObjet1 = :idObjet2
                    OR idObjet2 = :idObjet1 OR idObjet2 = :idObjet2
                )
                AND etat = 'en attente'
            ";
            $st = $this->pdo->prepare($sql);
            try {
                $st->execute([
                    ':idEchange' => $idEchange,
                    ':idObjet1' => $idObjet1,
                    ':idObjet2' => $idObjet2
                ]);
            } catch (PDOException $e) {
                $info = $st->errorInfo();
                throw new RuntimeException('CANCEL_OTHER_ECHANGE : DB error in verifyLogin(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
            }
            return true;
        }
    }