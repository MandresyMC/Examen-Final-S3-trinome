<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

    <?php include('header/header.php') ?>

    <div class="page-content">

        <!-- ═══ BESOINS & DONS ═══ -->
        <div class="section-heading">
            <span class="section-heading__dot dot-blue"></span>
            <span class="section-heading__label">Besoins &amp; Dons</span>
            <span class="section-heading__line"></span>
        </div>

        <?php if (empty($besoin)) { ?>
            <p class="alert-info">Aucun besoin disponible.</p>
        <?php } else { ?>
            <div class="cards-grid">
                <?php foreach ($besoin as $objet) {
                    $demande = $objet['quantiteDemandee'];
                    $recu    = $objet['totalDonne'];
                    $pct     = $demande > 0 ? min(100, round($recu / $demande * 100)) : 0;
                    $unite   = $objet['nomProduit'] != 'Argent' ? 'kg' : 'Ar';
                ?>
                <div class="img-card">
                    <img src="/assets/<?= strtolower($objet['nomProduit']) ?>.jpg"
                         alt="<?= htmlspecialchars($objet['nomProduit']) ?>">

                    <div class="img-card__content">
                        <span class="img-card__tag tag-blue"><?= htmlspecialchars($objet['villeNom']) ?></span>
                        <div class="img-card__title"><?= htmlspecialchars($objet['nomProduit']) ?></div>

                        <div class="img-card__stats">
                            <span class="stat-badge">Demandé : <strong><?= $demande ?> <?= $unite ?></strong></span>
                            <span class="stat-badge">Reçu : <strong><?= $recu ?> <?= $unite ?></strong></span>
                        </div>

                        <div class="progress-wrap">
                            <div class="progress-label">
                                <span>Progression</span>
                                <span><?= $pct ?>%</span>
                            </div>
                            <div class="progress-bar-bg">
                                <div class="progress-bar-fill <?= $pct >= 100 ? 'over' : '' ?>"
                                     style="width: <?= $pct ?>%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        <?php } ?>

        <!-- ═══ ACHATS ═══ -->
        <div class="section-heading">
            <span class="section-heading__dot dot-green"></span>
            <span class="section-heading__label">Achats effectués</span>
            <span class="section-heading__line"></span>
        </div>

        <?php if (empty($achat)) { ?>
            <p class="alert-info">Aucun achat disponible.</p>
        <?php } else { ?>
            <div class="cards-grid">
                <?php foreach ($achat as $objet) {
                    $unite = $objet['nomProduit'] != 'Argent' ? 'kg' : 'Ar';
                ?>
                <div class="img-card">
                    <img src="/assets/<?= strtolower($objet['nomProduit']) ?>.jpg"
                         alt="<?= htmlspecialchars($objet['nomProduit']) ?>">

                    <div class="img-card__content">
                        <span class="img-card__tag tag-green"><?= htmlspecialchars($objet['villeNom']) ?></span>
                        <div class="img-card__title"><?= htmlspecialchars($objet['nomProduit']) ?></div>

                        <div class="img-card__stats">
                            <span class="stat-badge">Qté : <strong><?= $objet['quantiteAchetee'] ?> <?= $unite ?></strong></span>
                            <span class="stat-badge">Dépense : <strong><?= number_format($objet['prixAchat'], 0, ',', ' ') ?> Ar</strong></span>
                        </div>

                        <div class="img-card__date"><?= $objet['dateAchat'] ?></div>
                    </div>
                </div>
                <?php } ?>
            </div>
        <?php } ?>

    </div>

</body>
</html>