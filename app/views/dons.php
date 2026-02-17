<?php
    $besoins = $besoins;
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dons</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
        <h1>Ville pouvant avoir un don</h1>

        <?php if (empty($besoins)) { ?>
            <p class="alert alert-info">Aucune ville disponible pour faire des dons.</p>
        <?php } else { ?>
            <?php foreach ($besoins as $besoin) { ?>
                <div class="card" style="width: 18rem;">
                    <img src="<?= $besoin['nomVille'] ?>" class="card-img-top" alt="<?= $besoin['nomVille'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $besoin['nomVille'] ?></h5>
                        <a href="/formulaire_dons?idBesoin=<?= $besoin['id'] ?>" class="btn btn-primary mt-3 w-100">Effectuer un don</a>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </body>
</html>