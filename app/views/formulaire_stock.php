<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un stock</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h3 class="mb-0">Ajouter un stock</h3>
        </div>

        <div class="card-body">

            <form action="/formulaire_stock" method="POST">

                <div class="mb-3">
                    <label for="cat" class="form-label">Catégorie</label>
                    <select name="cat" id="cat" class="form-select" required>
                        <option value="">-- Choisir une catégorie --</option>
                        <?php foreach ($categories as $cat) : ?>
                            <option value="<?= $cat['id'] ?>">
                                <?= $cat['nom'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="nom" class="form-label">Nom du produit</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>

                <div class="mb-3">
                    <label for="quantite_initiale" class="form-label">Quantité initiale</label>
                    <input type="number" class="form-control" id="quantite_initiale" name="quantite_initiale" min="0" required>
                </div>

                <div class="mb-3">
                    <label for="quantite_finale" class="form-label">Quantité finale</label>
                    <input type="number" class="form-control" id="quantite_finale" name="quantite_finale" min="0" required>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary w-100">Ajouter au stock</button>
                </div>

            </form>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
