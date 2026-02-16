<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="card shadow">
        <div class="card-header bg-success text-white text-center">
            <h3 class="mb-0">tableau de bord</h3>
        </div>    

        <div class="mb-3">
            <?php foreach ($villes as $ville) : ?>
                    <p><?= $ville['nom'] ?></p>
                    <p>achats</p>
                    <p>produit acheter</p>
                    <p>quantite </p>
                    <p>montant </p>
            <?php endforeach; ?>
        </div>

</body>
</html>