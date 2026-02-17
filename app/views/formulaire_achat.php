<?php
    $ville = $ville;
    $allStocksDons = $allStocksDons;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'achat</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/formulaire_achat.css">
</head>
<body>

    <?php include('header/header.php') ?>

    <div class="page-main">
        <div class="form-wrapper">
            <h1>Formulaire d'achat</h1>

            <?php if (isset($success)) { ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php } ?>
            <?php if (isset($error)) { ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php } ?>

            <?php if (empty($ville) || empty($allStocksDons)) { ?>
                <p class="alert alert-info">Aucune ville ou stock disponible pour faire des achats.</p>
            <?php } else { ?>

                <!-- Info ville -->
                <div class="info-block">
                    <div class="info-block__row">
                        <span class="info-block__label">Ville</span>
                        <span class="info-block__value"><?= $ville['nom'] ?></span>
                    </div>
                    <div class="info-block__row">
                        <span class="info-block__label">Fonds disponibles</span>
                        <span class="info-block__value"><?= number_format($ville['fond'], 0, ',', ' ') ?> Ar</span>
                    </div>
                </div>

                <form action="/formulaire_achat" method="post">
                    <input type="hidden" name="idVille" value="<?= $ville['id'] ?>">

                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock de dons</label>
                        <select name="idStock" id="stock" class="form-select" required>
                            <option value="">-- Choisir un stock --</option>
                            <?php foreach ($allStocksDons as $stock) { ?>
                                <?php if ($stock['nomProduit'] != 'Argent') { ?>
                                    <option value="<?= $stock['id'] ?>">
                                        <?= $stock['nomProduit'] ?> — <?= $stock['quantiteFinale'] ?> kg — <?= $stock['prixUnitaire'] ?> Ar/kg
                                    </option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="quantite" class="form-label">Quantité à acheter (kg)</label>
                        <input type="number" class="form-control" id="quantite" name="quantiteAchetee" min="1" required>
                    </div>

                    <button type="submit" class="btn-primary">Soumettre l'achat</button>
                </form>

            <?php } ?>
        </div>
    </div>

</body>
</html>