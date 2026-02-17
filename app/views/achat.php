<?php $allVilles = $allVilles; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Achat</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/achat.css">
</head>
<body>

    <?php include('header/header.php') ?>

    <div class="page-content">
        <h1>Villes pouvant faire des achats</h1>
        <?php if (empty($allVilles)) { ?>
            <p class="alert-info">Aucune ville disponible pour faire des achats.</p>
        <?php } else { ?>
            <div class="cards-grid">
                <?php foreach ($allVilles as $ville) { ?>
                    <div class="card">
                        <img src="../../public/assets/ $ville['image'] ?? 'default.jpg' ?>" 
                             class="card-img-top" 
                             alt="<?= htmlspecialchars($ville['nom']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($ville['nom']) ?></h5>
                            <a href="/formulaire_achat?idVille=<?= $ville['id'] ?>" class="btn-primary">
                                Effectuer un achat
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

</body>
</html>