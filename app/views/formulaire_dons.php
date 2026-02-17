<?php
    $stockDons = $stockDons;
    $besoin = $besoin;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Dons</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/formulaire_dons.css">
</head>
<body>

<?php include('header/header.php') ?>

<main class="page-main">
    <div class="form-wrapper">
        <h1>Formulaire Dons</h1>

        <?php if ($success) { ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php } ?>
        <?php if ($error) { ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php } ?>

        <?php if (!$besoin) { ?>
            <p class="alert alert-info">Besoin introuvable.</p>
        <?php } else { ?>

            <div class="info-block">
                <div class="info-block__row">
                    <span class="info-block__label">Ville à donner</span>
                    <span class="info-block__value"><?= htmlspecialchars($besoin['nomVille']) ?></span>
                </div>
                <div class="info-block__row">
                    <span class="info-block__label">Produit demandé</span>
                    <span class="info-block__value"><?= htmlspecialchars($besoin['nomProduit']) ?></span>
                </div>
                <div class="info-block__row">
                    <span class="info-block__label">Quantité demandée</span>
                    <span class="info-block__value">
                        <?= $besoin['quantiteDemandee'] ?>
                        <?= $besoin['nomProduit'] != 'Argent' ? 'kg' : 'Ar' ?>
                    </span>
                </div>
                <div class="info-block__row">
                    <span class="info-block__label">Stock disponible</span>
                    <span class="info-block__value">
                        <?= $stockDons['quantiteFinale'] ?>
                        <?= $stockDons['nomProduit'] != 'Argent' ? 'kg' : 'Ar' ?>
                    </span>
                </div>
            </div>

            <form action="ajout_dons" method="post">
                <input type="hidden" name="idBesoin" value="<?= $besoin['id'] ?>">
                <input type="hidden" name="idVille" value="<?= $besoin['idVille'] ?>">
                <input type="hidden" name="idStock" value="<?= $stockDons['id'] ?>">

                <div class="mb-3">
                    <label for="quantite" class="form-label">Quantité à donner</label>
                    <input type="number" class="form-control" id="quantite"
                           name="quantiteDonnee" min="1" required>
                </div>

                <button type="submit" class="btn-primary">Soumettre le don</button>
            </form>

            <a href="/dons" class="btn-outline-secondary">← Retour aux dons</a>

        <?php } ?>
    </div>
</main>

</body>
</html>