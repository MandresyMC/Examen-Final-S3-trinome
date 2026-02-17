<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Dons</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .cards-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            position: relative;
            width: 500px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            background-color: #fff;
        }

        .card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .card-content {
            padding: 15px;
            position: relative;
        }

        .card-content h4 {
            margin: 0;
            font-size: 18px;
        }

        .card-content p {
            margin: 5px 0;
            color: #555;
        }

        .badge {
            display: inline-block;
            background-color: #eee;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
            margin-top: 5px;
        }

        .btn-vendre {
            display: block;
            margin-top: 10px;
            background-color: #e74c3c;
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-weight: bold;
        }

        .btn-vendre:hover {
            background-color: #c0392b;
        }

        /* Superposition texte sur image */
        .card-image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 150px;
            background: rgba(0,0,0,0.4);
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 10px;
            box-sizing: border-box;
        }

    </style>
</head>
<body>
    <h2>Liste des Dons par Ville</h2>

    <?php if (isset($success)) { ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php } ?>
    <?php if (isset($error)) { ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php } ?>

    <div class="cards-container">
        <?php foreach($villeDons as $objet) { ?>
            <div class="card">
                <div style="position: relative;">
                    <img src="images/<?= strtolower($objet['nomVille']) ?>.jpg" alt="<?= $objet['nomVille'] ?>">
                    <div class="card-image-overlay">
                        <strong><?= $objet['nomVille'] ?></strong>
                    </div>
                </div>

                <div class="card-content">
                    <h4><?= $objet['nomProduit'] ?></h4>
                    <p>Quantité : <?= $objet['quantiteDonnee'] ?? 'N/A' ?></p>
                    <p>PrixUnitaire du produit : <?= $objet['prixUnitaire'] ?? 'N/A' ?> Ar</p>
                    <p>Prix total : <?= $objet['quantiteDonnee'] * $objet['prixUnitaire'] ?> Ar</p>

                    <?php if ($objet['statut'] != 'vendu') { ?>
                        <form action="/vente/create" method="POST">
                            <input type="hidden" name="idDons" value="<?= $objet['id'] ?>">
                            <button type="submit" class="btn-vendre" onclick="return confirm('Voulez-vous vendre ce don ?')">Vendre ce don</button>
                        </form>
                    <?php } else { ?>
                        <div class="alert alert-success">Dons déjà vendu</div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>
