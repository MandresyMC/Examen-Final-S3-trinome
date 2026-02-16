<?php
    $ville = $ville;
    $allStocksDons = $allStocksDons;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulaire d'achat</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
        <h1>Formulaire d'achat</h1>

        <?php if (isset($success)) { ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php } ?>
        <?php if (isset($error)) { ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php } ?>

        <?php if (empty($ville) || empty($allStocksDons)) { ?>
            <p class="alert alert-info">Aucune ville, produit ou stock de dons disponible pour faire des achats.</p>
        <?php } else { ?>
            <h2>Ville : <?= $ville['nom'] ?></h2>
            <h3>Montant : <?= $ville['fond'] ?> Ar</h3>
            
            <form action="/formulaire_achat" method="post">
                <input type="hidden" name="idVille" value="<?= $ville['id'] ?>">
                
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock de dons</label>
                    <select name="idStock" id="stock" class="form-select" required>
                        <option value="">-- Choisir un stock de dons --</option>
                        <?php foreach ($allStocksDons as $stock) { ?>
                            <?php if ($stock['nomProduit'] != 'Argent' ) { ?>
                                <option value="<?= $stock['id'] ?>">
                                    <?= $stock['nomProduit'] ?> - <?= $stock['quantiteFinale'] ?> kg - PU : <?= $stock['prixUnitaire'] ?> Ar/kg
                                </option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="quantite" class="form-label">Quantité à acheter (en kg)</label>
                    <input type="number" class="form-control" id="quantite" name="quantiteAchetee" min="1" required>
                </div>

                <button type="submit" class="btn btn-primary">Soumettre l'achat</button>
            </form>
        <?php } ?>
    </body>
</html>