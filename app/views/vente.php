<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<link rel="stylesheet" href="css/bootstrap.min.css">

<style>

body {
    margin: 0;
    background-color: #f4f4f4;
    font-family: 'Segoe UI', sans-serif;
}

/* MARGE UNIQUEMENT SUR LES CÔTÉS */
.side-padding {
    padding-left: 40px;
    padding-right: 40px;
}

/* TITRES */
.section-title {
    text-align: center;
    margin: 60px 0 30px;
    font-weight: 600;
    letter-spacing: 2px;
}

/* RECTANGLES */
.modern-card {
    position: relative;
    height: 450px;
    width: 100%;
    overflow: hidden;
}

/* IMAGE FULL */
.modern-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.8s ease;
}

.modern-card:hover img {
    transform: scale(1.05);
}

/* OVERLAY */
.modern-card::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to top,
        rgba(0,0,0,0.85),
        rgba(0,0,0,0.4),
        rgba(0,0,0,0.1)
    );
}

/* TEXTE */
.card-content {
    position: absolute;
    bottom: 0;
    padding: 40px;
    color: white;
    z-index: 2;
}

.card-content h4 {
    font-size: 26px;
    font-weight: 700;
    margin-bottom: 10px;
}

.card-content p {
    margin: 0;
    font-size: 15px;
    opacity: 0.9;
}

.badge-neutral {
    background: rgba(255,255,255,0.15);
    padding: 6px 14px;
    font-size: 13px;
    margin-right: 8px;
}
</style>


</head>

<body>

<div class="container-fluid side-padding">
    <h2 class="section-title">DONS</h2>

    <?php if(!$besoin) { ?>
        <p class="alert alert-info text-center">Aucun besoin disponible</p>
    <?php } else { ?>
    <div class="row g-0">
        <?php foreach ($besoin as $objet) { 
            $reste = $objet['quantiteDemandee'] - $objet['totalDonne'];
        ?>
        <div class="col-md-6 custom-col">

            <div class="modern-card shadow">

                <img src="images/<?= strtolower($objet['nomProduit']) ?>.jpg"
                     alt="<?= $objet['nomProduit'] ?>">

                <div class="card-content">
                    <h4><?= $objet['nomProduit'] ?></h4>
                    <p><?= $objet['villeNom'] ?></p>

                    <div class="mt-2">
                        <span class="badge-neutral">
                            quantite : <?= $objet['totalDonne'] ?>
                        </span>
                        <span>
                            <button type="submit" class="btn-danger">vendre un dons</button>
                        </span>
                             
                    </div>
                </div>

            </div>
        </div>
        <?php } ?>
    </div>
    <?php } ?>




</div>

</body>
</html>
