<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Dons</title>
<<<<<<< HEAD
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/vente.css">
</head>
<body>
=======
    <link rel="stylesheet" href="css/liste_dons.css">
</head>
<body>

<?php include('header/header.php') ?>

<main class="page-main">
    <div class="page-header">
        <h1>Liste des Dons par Ville</h1>
    </div>
>>>>>>> 6f96a99059d658e9d3e997f4cc1adf213143b971

    <?php include('header/header.php') ?>

<<<<<<< HEAD
    <div class="page-content">
        <h2>Liste des Dons par Ville</h2>

        <?php if (isset($success)) { ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php } ?>
        <?php if (isset($error)) { ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php } ?>

        <div class="cards-container">
            <?php foreach ($villeDons as $objet) { ?>
                <div class="card">
                    <div class="card-img-wrap">
                        <img src="/assets/<?= strtolower($objet['nomVille']) ?>.jpg"
                             alt="<?= htmlspecialchars($objet['nomVille']) ?>">
                        <span class="card-img-label"><?= htmlspecialchars($objet['nomVille']) ?></span>
                    </div>

                    <div class="card-body">
                        <div class="card-title"><?= htmlspecialchars($objet['nomProduit']) ?></div>

                        <div class="card-rows">
                            <div class="card-row">
                                <span class="card-row__label">Quantité</span>
                                <span class="card-row__value"><?= $objet['quantiteDonnee'] ?? 'N/A' ?> kg</span>
                            </div>
                            <div class="card-row">
                                <span class="card-row__label">Prix unitaire</span>
                                <span class="card-row__value"><?= $objet['prixUnitaire'] ?? 'N/A' ?> Ar/kg</span>
                            </div>
                            <div class="card-row">
                                <span class="card-row__label">Prix total</span>
                                <span class="card-row__value highlight">
                                    <?= number_format($objet['quantiteDonnee'] * $objet['prixUnitaire'], 0, ',', ' ') ?> Ar
                                </span>
                            </div>
                        </div>

                        <form action="/vente/create" method="POST">
                            <input type="hidden" name="idDons" value="<?= $objet['id'] ?>">
                            <button type="submit" class="btn-vendre"
                                    onclick="return confirm('Voulez-vous vendre ce don ?')">
                                Vendre ce don
                            </button>
                        </form>
=======
    <div class="cards-grid">
        <?php foreach($villeDons as $objet) { ?>
            <div class="don-card <?= $objet['statut'] === 'vendu' ? 'is-sold' : '' ?>">

                <div class="don-card__image-wrap">
                    <img src="assets/<?= $objet['nomVille'] ?>.jpg"
                         alt="<?= $objet['nomVille'] ?>"
                         onerror="this.style.display='none'">
                    <div class="don-card__image-overlay">
                        <span class="don-card__ville"><?= $objet['nomVille'] ?></span>
>>>>>>> 6f96a99059d658e9d3e997f4cc1adf213143b971
                    </div>
                    <?php if ($objet['statut'] === 'vendu') { ?>
                        <div class="don-card__sold-badge">Vendu</div>
                    <?php } ?>
                </div>
<<<<<<< HEAD
            <?php } ?>
        </div>
    </div>

    <?php include('footer/footer.php') ?>
=======

                <div class="don-card__body">
                    <h3 class="don-card__product"><?= $objet['nomProduit'] ?></h3>

                    <div class="don-card__info">
                        <div class="don-card__info-row">
                            <span class="don-card__info-label">Quantité</span>
                            <span class="don-card__info-value">
                                <?= number_format($objet['quantiteDonnee'] ?? 0, 0, ',', ' ') ?>
                                <?= $objet['nomProduit'] !== 'Argent' ? 'kg' : 'Ar' ?>
                            </span>
                        </div>
                        <div class="don-card__info-row">
                            <span class="don-card__info-label">Prix unitaire</span>
                            <span class="don-card__info-value">
                                <?= number_format($objet['prixUnitaire'] ?? 0, 0, ',', ' ') ?> Ar
                            </span>
                        </div>
                        <div class="don-card__info-row is-total">
                            <span class="don-card__info-label">Prix total</span>
                            <span class="don-card__info-value">
                                <?= number_format(($objet['quantiteDonnee'] ?? 0) * ($objet['prixUnitaire'] ?? 0), 0, ',', ' ') ?> Ar
                            </span>
                        </div>
                    </div>

                    <?php if ($objet['statut'] !== 'vendu') { ?>
                        <form action="/vente/create" method="POST">
                            <input type="hidden" name="idDons" value="<?= $objet['id'] ?>">
                            <button type="submit" class="btn-sell"
                                    onclick="return confirm('Confirmer la vente de ce don ?')">
                                Vendre ce don
                            </button>
                        </form>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</main>
>>>>>>> 6f96a99059d658e9d3e997f4cc1adf213143b971

</body>
</html>