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
        <?php if (empty($achats)) : ?>
            <p>Aucun achat</p>
        <?php else : ?>
            <?php foreach ($achats as $achat) : ?>
                <p>Ville : <?= htmlspecialchars($achat['idVille']) ?></p>
                <p>Achat</p>
                <p>Produit acheté</p>
                <p>Quantité</p>
                <p>Montant</p>
                <hr>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</body>
</html>