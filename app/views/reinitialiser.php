<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/formulaire_besoin.css">
</head>
<body>

    <?php include('header/header.php') ?>

    <div class="page-content">
        <div class="form-wrapper">
            <h1>Réinitialisation</h1>

            <?php if (isset($success)) { ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php } ?>
            <?php if (isset($error)) { ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php } ?>

            <form action="reinitialiser/valider" method="POST">

                <div class="field-group">
                    <label for="quantite" class="field-label">Réinitialiser les données ?</label>
                </div>

                <button type="submit" class="btn-danger" onclick="return confirm('Valider ?')">Réinitialiser</button>
                
            </form>
        </div>
    </div>

    <?php include('footer/footer.php') ?>

</body>
</html>