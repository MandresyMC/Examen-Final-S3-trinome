<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un stock</title>
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
            <?php if ($error) { ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php } ?>

            <form action="/formulaire_stock" method="POST">

                <div class="mb-3">
                    <label for="idProduit" class="form-label">Produit</label>
                    <select name="idProduit" id="idProduit" class="form-select" required>
                        <option value="">-- Choisir un produit --</option>
                        <?php foreach ($produits as $produit) { ?>
                            <option value="<?= $produit['id'] ?>"><?= $produit['nom'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="quantite_initiale" class="form-label">Quantité initiale</label>
                    <input type="number" class="form-control" id="quantite_initiale" name="quantite_initiale" min="0" required>
                </div>

                <button type="submit" class="btn-primary">Ajouter au stock</button>

            </form>
        </div>
    </div>

</body>
</html>