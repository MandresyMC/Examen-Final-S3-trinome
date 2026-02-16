<?php
    $allVilles = $allVilles;
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Achat</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
        <h1>Ville pouvant faire d'achat</h1>

        <?php if (empty($allVilles)) { ?>
            <p class="alert alert-info">Aucune ville disponible pour faire des achats.</p>
        <?php } else { ?>
            <?php foreach ($allVilles as $ville) { ?>
                <div class="card" style="width: 18rem;">
                    <img src="<?= $ville['nom'] ?>" class="card-img-top" alt="<?= $ville['nom'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $ville['nom'] ?></h5>
                        <a href="/formulaire_achat?idVille=<?= $ville['id'] ?>" class="btn btn-primary mt-3 w-100">Effectuer un achat</a>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </body>
</html>