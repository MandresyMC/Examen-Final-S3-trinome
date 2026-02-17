<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Dons</title>
    <link rel="stylesheet" href="css/liste_dons.css">
</head>
<body>

<?php include('header/header.php') ?>

<main class="page-main">
    <div class="page-header">
        <h1>Liste des Dons par Ville</h1>
    </div>

    <?php if (isset($success)) { ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php } ?>
    <?php if (isset($error)) { ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php } ?>

    <div class="cards-grid">
        <?php foreach($villeDons as $objet) { ?>
            <div class="don-card <?= $objet['statut'] === 'vendu' ? 'is-sold' : '' ?>">

                <div class="don-card__image-wrap">
                    <img src="images/<?= strtolower($objet['nomVille']) ?>.jpg"
                         alt="<?= $objet['nomVille'] ?>"
                         onerror="this.style.display='none'">
                    <div class="don-card__image-overlay">
                        <span class="don-card__ville"><?= $objet['nomVille'] ?></span>
                    </div>
                    <?php if ($objet['statut'] === 'vendu') { ?>
                        <div class="don-card__sold-badge">Vendu</div>
                    <?php } ?>
                </div>

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

</body>
</html>