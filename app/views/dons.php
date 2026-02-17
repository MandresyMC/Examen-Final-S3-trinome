<?php $besoins = $besoins; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dons</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/dons.css">
</head>
<body>

    <?php include('header/header.php') ?>

    <div class="page-content">
        <h1>Villes pouvant avoir un don</h1>

        <?php if (empty($besoins)) { ?>
            <p class="alert-info">Aucune ville disponible pour faire des dons.</p>
        <?php } else { ?>
            <div class="cards-grid">
                <?php foreach ($besoins as $besoin) { ?>
                    <div class="card">
                        <img src="/assets/<?= strtolower($besoin['nomVille']) ?>.jpg"
                             class="card-img-top"
                             alt="<?= htmlspecialchars($besoin['nomVille']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($besoin['nomVille']) ?></h5>
                            <a href="/formulaire_dons?idBesoin=<?= $besoin['id'] ?>" class="btn-primary">
                                Effectuer un don
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

</body>
</html>