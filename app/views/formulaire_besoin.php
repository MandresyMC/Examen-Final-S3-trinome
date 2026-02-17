<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un besoin</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/formulaire_besoin.css">
</head>
<body>

    <?php include('header/header.php') ?>

    <div class="page-content">
        <div class="form-wrapper">
            <h1>Ajouter un besoin</h1>

            <?php if (isset($success)) { ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php } ?>
            <?php if (isset($error)) { ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php } ?>

            <form action="/formulaire_besoin" method="POST">

                <div class="field-group">
                    <span class="field-label">Ville</span>
                    <div class="ville-grid">
                        <?php foreach ($villes as $ville) { ?>
                            <input type="radio" name="ville" id="ville_<?= $ville['id'] ?>" value="<?= $ville['id'] ?>" required>
                            <label for="ville_<?= $ville['id'] ?>">
                                <img src="/assets/<?= strtolower($ville['nom']) ?>.jpg" alt="<?= $ville['nom'] ?>">
                                <span><?= $ville['nom'] ?></span>
                            </label>
                        <?php } ?>
                    </div>
                </div>

                <div class="field-group">
                    <span class="field-label">Produit</span>
                    <div class="produit-grid">
                        <?php
                        $icons = ['Riz' => '🌾', 'Argent' => '💰'];
                        foreach ($produits as $produit) {
                            $icon = $icons[$produit['nom']] ?? '📦';
                        ?>
                            <input type="radio" name="idProduit" id="produit_<?= $produit['id'] ?>" value="<?= $produit['id'] ?>" required>
                            <label for="produit_<?= $produit['id'] ?>">
                                <span class="icon"><?= $icon ?></span>
                                <span><?= $produit['nom'] ?></span>
                            </label>
                        <?php } ?>
                    </div>
                </div>

                <div class="field-group">
                    <label for="quantite" class="field-label">Quantité (Ar ou kg)</label>
                    <input type="number" class="form-control" id="quantite" name="quantite" min="1" required>
                </div>

                <button type="submit" class="btn-danger">Ajouter</button>

            </form>
        </div>
    </div>

</body>
</html>