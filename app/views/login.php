<?php
  $email = $values['email'] ?? null;
  $password = $values['password'] ?? null;

  $emailError = $errors['email'] ?? null;
  $passwordError = $errors['password'] ?? null;
  $globalError = $errors['global'] ?? null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header text-center"><h4>Login utilisateur</h4></div>
        <div class="card-body">

          <?php if ($globalError) { ?>
            <div class="alert alert-danger"><?= $globalError ?? '' ?></div>
          <?php } ?>

          <form id="registerForm" method="post" action="/login" novalidate>
            <div id="formStatus" class="alert d-none"></div>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input id="email" name="email" type="email" class="form-control <?= !empty($emailError) ? 'is-invalid' : '' ?>" value="<?= $email ?? '' ?>">
              <div class="invalid-feedback" id="emailError"><?= $emailError ?? '' ?></div>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Mot de passe</label>
              <input id="password" name="password" type="password" class="form-control <?= !empty($passwordError) ? 'is-invalid' : '' ?>" value="<?= $password ?? '' ?>">
              <div class="invalid-feedback" id="passwordError"><?= $passwordError ?? '' ?></div>
              <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" id="showPassword" onclick="document.getElementById('password').type = this.checked ? 'text' : 'password'">
                <label class="form-check-label" for="showPassword">Afficher le mot de passe</label>
              </div>
            </div>

            <button class="btn btn-primary w-100" type="submit">Log in</button>
            <p class="text-center text-secondary mt-3 small">Pas de compte? <a href="register">S'inscrire</a></p>
          </form>

          <script src="/js/login-ajax.js" defer></script>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
