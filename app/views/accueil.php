<?php
    $current_user = $current_user;
    if ($error) { ?>
        <script>
            alert(<?= $error ?>)
        </script>
    <?php }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Takalo</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
</head>
<body>
    <!-- Navigation -->
    <?php include('header/header.php') ?>

    <!-- Main content -->
    <div class="container-fluid py-4">
        <h1 class="mb-4">Objets disponibles pour l'échange</h1>

        <?php if (empty($objets)) { ?>
            <div class="alert alert-info" role="alert">
                <i class="bi bi-info-circle"></i> Aucun objet disponible pour l'échange pour le moment.
            </div>
        <?php } else { ?>
            <div class="row g-4">
                <?php foreach ($objets as $objet) {
                    if ($objet['idUser'] != $current_user) { ?>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm">
                                <!-- Photo -->
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px; overflow: hidden;">
                                    <?php if (!empty($objet['photo'])) { ?>
                                        <img src="public/images/<?= ($objet['photo']) ?>" 
                                            alt="<?= ($objet['titre']) ?>"
                                            class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                                    <?php } else { ?>
                                        <div class="text-muted">
                                            <i class="bi bi-image" style="font-size: 3rem;"></i>
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="card-body">
                                    <!-- Titre -->
                                    <h5 class="card-title"><?= ($objet['titre']); ?></h5>

                                    <!-- Description -->
                                    <p class="card-text text-muted">
                                        <?= (substr($objet['description'], 0, 100)); ?>
                                        <?php if (strlen($objet['description']) > 100): ?>...<?php endif; ?>
                                    </p>

                                    <!-- Prix -->
                                    <?php if (!empty($objet['prix'])) { ?>
                                        <div class="mb-3">
                                            <span class="badge bg-success">Prix: <?= number_format($objet['prix'], 0, ',', ' '); ?> Ar</span>
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="card-footer bg-white">
                                    <!-- Bouton Echanger -->
                                    <a href="/echange?idObjet=<?= $objet['id'] ?>" 
                                    class="btn btn-primary w-100">
                                        <i class="bi bi-arrow-left-right"></i> Proposer un échange
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
