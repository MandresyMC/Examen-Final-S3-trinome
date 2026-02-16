
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <h1>Liste des besoins des villes et dons attribue</h1>
    
    <?php if(!$besoin) { ?>
        <p class="alert alert-info">Aucun besoin disponible</p>
    <?php } else { ?>
        <table class="table table-striped">
            <tr>
                <th>ville</th>
                <th>Produit demande</th>
                <th>quantite demande</th>
                <th>quantite recu</th>
            </tr>
            <?php foreach ($besoin as $objet) { ?>
            <tr>
                <td><?= $objet['villeNom'] ?></td>
                <td><?= $objet['nomProduit'] ?></td>
                <td><?= $objet['quantiteDemandee'] ?></td>
                <td><?= $objet['totalDonne'] ?></td>
            </tr>
            <?php } ?>
        <?php } ?>
    </table>

    <h1>liste des achats effectuer</h1>
    <?php if(!$achat) { ?>
        <p class="alert alert-info">Aucun besoin disponible</p>
    <?php } else { ?>
        <table class="table table-striped">
            <tr>
                <th>ville</th>
                <th>Produit achete</th>
                <th>quantite acheter</th>
                <th>depense Achat</th>
                <th>Date d'achat</th>
            </tr>
            <?php foreach ($achat as $objet) { ?>
            <tr>
                <td><?= $objet['villeNom'] ?></td>
                <td><?= $objet['nomProduit'] ?></td>
                <td><?= $objet['quantiteAchetee'] ?></td>
                <td><?= $objet['prixAchat'] ?></td>
                <td><?= $objet['dateAchat'] ?></td>
            </tr>
            <?php } ?>
        <?php } ?>
    </table>
</body>
</html>