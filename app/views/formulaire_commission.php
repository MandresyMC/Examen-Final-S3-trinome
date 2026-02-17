<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la commission</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/formulaire_commission.css">
</head>
<body>

    <?php include('header/header.php') ?>

    <div class="page-content">
        <div class="form-wrapper">
            <h1>Modifier la commission</h1>

            <?php if (isset($success) && $success) { ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php } ?>
            <?php if (isset($error) && $error) { ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php } ?>

            <p class="alert alert-info">Commission actuel : <?= $commission['pourcentage'] ?>%</p>

            <form action="/commission" method="POST">
                <input type="hidden" name="id" value="<?= $commission['id'] ?>">

                <div class="field-group">
                    <label for="pourcentage" class="field-label">Pourcentage de commission (%)</label>
                    <input 
                        type="number" 
                        class="form-control" 
                        id="pourcentage" 
                        name="pourcentage" 
                        step="0.01" 
                        min="0" 
                        max="100" 
                        required>
                </div>

                <button type="submit" class="btn-primary">Mettre à jour</button>

            </form>
        </div>
    </div>

    <?php include('footer/footer.php') ?>

</body>
</html>
