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

            <form action="/formulaire_produit" method="POST">
                
                <div class="field-group">
                    <label for="nomProduit" class="field-label">nom produit</label>
                    <input type="text" class="form-control" id="nomProduit" name="nomProduit" min="0" required>
                </div>

                <div class="field-group">
                    <label for="idCategorie" class="field-label">id Categorie</label>
                    <input type="text" class="form-control" id="idCategorie" name="idCategorie" min="0" required>
                </div>

                <div class="field-group">
                    <label for="prixUnitaire" class="field-label">Prix unitaire</label>
                    <input type="number" class="form-control" id="prixUnitaire" name="prixUnitaire" min="0" step="0.01" required>
                </div>


                <button type="submit" class="btn-primary">Ajouter produit</button>

            </form>
        </div>
    </div>

</body>
</html>