<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Dons</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/vente.css">
</head>
<body>

    <?php include('header/header.php') ?>

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

                        <?php if ($objet['statut'] !== 'vendu') { ?>
                            <form action="/vente/create" method="POST">
                                <input type="hidden" name="idDons" value="<?= $objet['id'] ?>">
                                <button type="submit" class="btn-vendre"
                                        onclick="return confirm('Voulez-vous vendre ce don ?')">
                                    Vendre ce don
                                </button>
                            </form>
                        <?php } ?>
                    </div>
                    <?php if ($objet['statut'] === 'vendu') { ?>
                        <div class="don-card__sold-badge">Vendu</div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php include('footer/footer.php') ?>

</body>
</html>