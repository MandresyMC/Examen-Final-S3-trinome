<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .section-title {
            margin: 40px 0 20px;
            font-weight: bold;
            text-align: center;
        }

        .card {
            border-radius: 15px;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .badge-custom {
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="container">

    <!-- ================= BESOINS ================= -->
    <h2 class="section-title">Besoins & Dons des Villes</h2>

    <?php if(!$besoin) { ?>
        <p class="alert alert-info text-center">Aucun besoin disponible</p>
    <?php } else { ?>
        <div class="row">
            <?php foreach ($besoin as $objet) { 
                $reste = $objet['quantiteDemandee'] - $objet['totalDonne'];
                $pourcentage = $objet['quantiteDemandee'] > 0 
                    ? ($objet['totalDonne'] / $objet['quantiteDemandee']) * 100 
                    : 0;
            ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    
                    <!-- IMAGE PRODUIT -->
                    <img src="images/<?= strtolower($objet['nomProduit']) ?>.jpg"
                         alt="<?= $objet['nomProduit'] ?>">

                    <div class="card-body text-center">
                        <h5><?= $objet['nomProduit'] ?></h5>
                        <p class="text-muted"><?= $objet['villeNom'] ?></p>

                        <p>
                            <span class="badge bg-primary badge-custom">
                                Demandé : <?= $objet['quantiteDemandee'] ?>
                            </span>
                        </p>

                        <p>
                            <span class="badge bg-success badge-custom">
                                Reçu : <?= $objet['totalDonne'] ?>
                            </span>
                        </p>

                   

                        <!-- BARRE DE PROGRESSION -->
                        <div class="progress mt-3">
                            <div class="progress-bar bg-success"
                                 style="width: <?= $pourcentage ?>%">
                                <?= round($pourcentage) ?>%
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    <?php } ?>


    <!-- ================= ACHATS ================= -->
    <h2 class="section-title">Achats Effectués</h2>

    <?php if(!$achat) { ?>
        <p class="alert alert-info text-center">Aucun achat disponible</p>
    <?php } else { ?>
        <div class="row">
            <?php foreach ($achat as $objet) { ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">

                    <!-- IMAGE PRODUIT -->
                    <img src="images/<?= strtolower($objet['nomProduit']) ?>.jpg"
                         alt="<?= $objet['nomProduit'] ?>">

                    <div class="card-body text-center">
                        <h5><?= $objet['nomProduit'] ?></h5>
                        <p class="text-muted"><?= $objet['villeNom'] ?></p>

                        <p>
                            <span class="badge bg-info">
                                Quantité : <?= $objet['quantiteAchetee'] ?>
                            </span>
                        </p>

                        <p>
                            <span class="badge bg-warning text-dark">
                                Dépense : <?= number_format($objet['prixAchat'], 2) ?> Ar
                            </span>
                        </p>

                        <p class="text-muted mt-2">
                            <small><?= $objet['dateAchat'] ?></small>
                        </p>

                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    <?php } ?>

</div>

</body>
</html>
