<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un besoin</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header bg-success text-white text-center">
            <h3 class="mb-0">Ajouter un besoin</h3>
        </div>

        <div class="card-body">

            <form action="/formulaire_besoin" method="POST">

                <div class="mb-3">
                    <label for="ville" class="form-label">Ville</label>
                    <select name="ville" id="ville" class="form-select" required>
                        <option value="">-- Choisir une ville --</option>
                        <?php foreach ($villes as $ville) { ?>
                            <option value="<?= $ville['id'] ?>">
                                <?= $ville['nom'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="cat" class="form-label">Catégorie</label>
                    <select name="cat" id="cat" class="form-select" required>
                        <option value="">-- Choisir une catégorie --</option>
                        <?php foreach ($categories as $cat) { ?>
                            <option value="<?= $cat['id'] ?>">
                                <?= $cat['nom'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom du produit</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>

                <div class="mb-3">
                    <label for="quantite" class="form-label">Quantité demandée</label>
                    <input type="number" class="form-control" id="quantite" name="quantite" min="1" required>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success w-100">Ajouter</button>
                </div>

            </form>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
