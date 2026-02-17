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
        <h1>Villes pouvant avoir un don / Liste des besoins</h1>

        <?php if (empty($besoins)) { ?>
            <p class="alert-info">Aucune ville disponible pour faire des dons.</p>
        <?php } else { ?>
            <div class="cards-grid">
                <?php foreach ($besoins as $besoin) {
                    $demande = $besoin['quantiteDemandee'];
                    $recu    = $besoin['totalDonne'];
                    $pct     = $demande > 0 ? min(100, round($recu / $demande * 100)) : 0;
                    $unite   = $besoin['nomProduit'] != 'Argent' ? 'kg' : 'Ar';
                ?>
                    <div class="card">
                        <img src="/assets/<?= strtolower($besoin['nomVille']) ?>.jpg"
                             class="card-img-top"
                             alt="<?= $besoin['nomVille'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $besoin['nomVille'] ?></h5>
                            <div class="progress-wrap">
                                <div class="progress-label">
                                    <span><?= $recu ?> / <?= $demande ?> <?= $unite ?></span>
                                    <span><?= $pct ?>%</span>
                                </div>
                                <div class="progress-bar-bg">
                                    <div class="progress-bar-fill <?= $pct >= 100 ? 'over' : '' ?>"
                                         style="width: <?= $pct ?>%"></div>
                                </div>
                            </div>
                            <a href="/formulaire_dons?idBesoin=<?= $besoin['id'] ?>" class="btn-primary">
                                Effectuer un don
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

    <?php include('footer/footer.php') ?>
    
</body>
</html>