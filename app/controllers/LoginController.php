<?php
class LoginController {

  public static function showLogin() {
    Flight::render('login', [
      'values' => ['email'=>'','password'=>''],
      'errors' => ['email'=>'','password'=>''],
      'success' => false
    ]);
  }

  public static function postLogin() {
    $pdo  = Flight::db();
    $repo = new UserRepository($pdo);
    // $repoMess = new MessageRepository($pdo);

    $req = Flight::request();

    $input = [
      'email' => $req->data->email,
      'password' => $req->data->password,
    ];

    $retour = $repo->verifyLogin($input['email'], $input['password']);
    $_SESSION['current_user'] = $retour;
    // $repoMess->compareLastMessageUserIdWithCurrent($retour);
    // $messages = $repoMess->findAll();
    
    // Flight::render('index', [
    //   'user_id' => $retour,
    //   'messages' => $messages,
    //   'user_nom' => $input['nom'],
    // ]);

    Flight::redirect("/accueil");
    
  }
}
