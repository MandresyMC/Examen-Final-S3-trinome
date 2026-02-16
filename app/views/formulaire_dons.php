<?php
    $villes = $villes;
    $stocksDons = $stocksDons;
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulaire Dons</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
        <h1>Formulaire Dons</h1>

        <?php if ($success) { ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php } ?>

        <?php if (empty($villes) && empty($stocksDons)) { ?>
            <p class="alert alert-info">Aucune ville ni stock de dons disponible.</p>
        <?php } else { ?>
            <form action="ajout_dons" method="post">
                <div class="mb-3">
                    <label for="ville" class="form-label">Ville</label>
                    <select name="idVille" id="ville" class="form-select" required>
                        <option value="">-- Choisir une ville --</option>
                        <?php foreach ($villes as $ville) { ?>
                            <option value="<?= $ville['id'] ?>">
                                <?= $ville['nom'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Stock de dons</label>
                    <select name="idStock" id="stock" class="form-select" required>
                        <option value="">-- Choisir un stock de dons --</option>
                        <?php foreach ($stocksDons as $stock) { ?>
                            <option value="<?= $stock['id'] ?>">
                                <?= $stock['nomProduit'] ?> - <?= $stock['quantiteInitiale'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="quantite" class="form-label">Quantité à donner</label>
                    <input type="number" class="form-control" id="quantite" name="quantite" min="1" required>
                </div>

                <button type="submit" class="btn btn-primary">Soumettre le don</button>
            </form>
        <?php } ?>
    </body>
</html>