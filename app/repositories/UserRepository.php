<?php
class UserRepository {
  private $pdo;
  public function __construct(PDO $pdo) { $this->pdo = $pdo; }

  public function create($email, $password) {
    $st = $this->pdo->prepare("
      INSERT INTO users(email, password)
      VALUES(?)
    ");
    try {
      $st->execute([ (string)$email, $password ]);
    } catch (PDOException $e) {
      // Ajoute des infos utiles pour le debug
      $info = $st->errorInfo();
      throw new RuntimeException('CREATE : DB error in create(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
    }
    return $this->pdo->lastInsertId();
  }

  public function verifyLogin($email, $password) {
    $st = $this->pdo->prepare("SELECT * FROM users WHERE email=? AND password=? LIMIT 1");
    try {
      $st->execute([ (string)$email, $password ]);
    } catch (PDOException $e) {
      $info = $st->errorInfo();
      throw new RuntimeException('VERIFYLOGIN : DB error in verifyLogin(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
    }
    
    $user = $st->fetch();
    if (!$user) {
      $id = $this->create($email, $password);
      return $id;
    }
    
    return $user['id'];
  }

  public function getNomById($user_id) {
    $st = $this->pdo->prepare("SELECT * FROM users WHERE id=? LIMIT 1");
    try {
      $st->execute([ (int)$user_id ]);
    } catch (PDOException $e) {
      $info = $st->errorInfo();
      throw new RuntimeException('RECHERCHENOM : DB error in verifyLogin(): ' . $e->getMessage() . ' - SQLSTATE: ' . ($info[0] ?? '') . ' - DriverMsg: ' . ($info[2] ?? ''));
    }
    
    $user = $st->fetch();
    
    return $user['email'] ?? false;
  }

}
