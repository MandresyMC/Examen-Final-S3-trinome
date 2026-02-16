<?php
    $villes = $villes;
    $stocksDons = $stocksDons;
    $success = $success ?? null;
    $error = $error ?? null;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Dons Moderne</title>
    <link rel="stylesheet" href="css/header.css">

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #f4f4f4;
        }

        .section-title {
            text-align: center;
            margin: 40px 0 20px;
            font-weight: 600;
        }

        .alert {
            text-align: center;
            margin: 10px auto 20px;
            padding: 10px;
            width: 90%;
            border-radius: 4px;
        }

        .alert-success { background-color: #d4edda; color: #155724; }
        .alert-danger { background-color: #f8d7da; color: #721c24; }
        .alert-info { background-color: #d1ecf1; color: #0c5460; }

        /* Container Flex pour 2 par 2 */
        .container-fluid {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 20px;
        }

        .modern-card-wrapper {
            width: calc(50% - 10px);
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .modern-card-wrapper {
                width: 100%;
            }
        }

        /* Modern Card */
        .modern-card {
            position: relative;
            height: 350px;
            overflow: hidden;
            border-radius: 0;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .modern-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
            display: block;
        }

        .modern-card:hover img {
            transform: scale(1.05);
        }

        /* Overlay sombre */
        .modern-card::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.6), rgba(0,0,0,0.1));
        }

        /* Formulaire superposé avec glassmorphism */
        .card-overlay-form {
            position: absolute;
            bottom: 10px;
            left: 10px;
            z-index: 2;
            color: white;
            padding: 15px;
            width: calc(100% - 20px);
            backdrop-filter: blur(8px);
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            opacity: 0;
            transform: translateY(20px);
            transition: 0.3s ease;
        }

        .modern-card:hover .card-overlay-form {
            opacity: 1;
            transform: translateY(0);
        }

        .card-overlay-form h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        /* Inputs et select compacts */
        .card-overlay-form select,
        .card-overlay-form input {
            width: 100%;
            max-width: 180px;
            padding: 6px 8px;
            margin-bottom: 6px;
            border: none;
            border-radius: 5px;
            outline: none;
            font-size: 14px;
        }

        .card-overlay-form button {
            padding: 6px 12px;
            background: white;
            color: black;
            border: none;
            font-weight: bold;
            cursor: pointer;
            font-size: 14px;
            border-radius: 5px;
            transition: 0.3s;
        }

        .card-overlay-form button:hover {
            background: #ddd;
        }

    </style>
</head>
<body>

<?php include('header/header.php'); ?>

<main class="page-main">

    <h1 class="section-title">Formulaire Dons Moderne</h1>

    <?php if ($success) { ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php } ?>
    <?php if ($error) { ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php } ?>

    <?php if (empty($villes) && empty($stocksDons)) { ?>
        <p class="alert alert-info text-center">Aucune ville ni stock de dons disponible.</p>
    <?php } else { ?>

        <div class="container-fluid">

            <?php foreach ($villes as $ville) { ?>
                <div class="modern-card-wrapper">
                    <div class="modern-card">

                        <!-- IMAGE PAR DEFAUT -->
                        <img src="images/default-ville.jpg" alt="<?= $ville['nom'] ?>">

                        <!-- Formulaire superposé au hover -->
                        <div class="card-overlay-form">
                            <form action="ajout_dons" method="post">

                                <input type="hidden" name="idVille" value="<?= $ville['id'] ?>">

                                <h3><?= $ville['nom'] ?></h3>

                                <select name="idStock" required>
                                    <option value="">Choisir un stock</option>
                                    <?php foreach ($stocksDons as $stock) { ?>
                                        <option value="<?= $stock['id'] ?>">
                                            <?= $stock['nomProduit'] ?> - <?= $stock['quantiteFinale'] ?>
                                            <?= $stock['nomProduit'] != 'Argent' ? ' kg' : ' Ar' ?>
                                        </option>
                                    <?php } ?>
                                </select>

                                <input type="number" name="quantiteDonnee" min="1" placeholder="Quantité" required>

                                <button type="submit">Donner</button>

                            </form>
                        </div>

                    </div>
                </div>
            <?php } ?>

        </div>

    <?php } ?>

</main>

</body>
</html>
