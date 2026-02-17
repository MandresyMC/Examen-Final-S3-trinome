<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un stock</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/formulaire_stock.css">
</head>
<body>

    <?php include('header/header.php') ?>

    <div class="page-content">
        <div class="form-wrapper">
            <h1>Ajouter un stock</h1>

            <?php if (isset($success)) { ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php } ?>
            <?php if (isset($error)) { ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php } ?>

            <form action="/formulaire_stock" method="POST">

                <div class="field-group">
                    <span class="field-label">Produit</span>
                    <div class="produit-grid">
                        <?php
                        $icons = ['Riz' => '🌾', 'Argent' => '💰'];
                        foreach ($produits as $produit) {
                            $icon = $icons[$produit['nom']] ?? '📦';
                        ?>
                            <input type="radio" name="idProduit" id="prod_<?= $produit['id'] ?>" value="<?= $produit['id'] ?>" required>
                            <label for="prod_<?= $produit['id'] ?>">
                                <span class="icon"><?= $icon ?></span>
                                <span><?= $produit['nom'] ?></span>
                            </label>
                        <?php } ?>
                    </div>
                </div>

                <div class="field-group">
                    <label for="quantite_initiale" class="field-label">Quantité initiale</label>
                    <input type="number" class="form-control" id="quantite_initiale" name="quantite_initiale" min="0" required>
                </div>

                <button type="submit" class="btn-primary">Ajouter au stock</button>

            </form>
        </div>
    </div>

</body>
</html>