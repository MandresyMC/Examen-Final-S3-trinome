
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
    
    <?php if(!$allObjets) { ?>
        <p class="alert alert-info">Aucun objet disponible</p>
    <?php } else { ?>
        <table class="table table-striped">
            <tr>
                <th>idCat</th>
                <th>quantiteDemande</th>
                <th>produit</th>
                <th>ville</th>
                <th>quantiteDonne</th>
            </tr>
            <?php foreach ($allObjets as $objet) { ?>
                <tr>
                    <td><?= $objet['idCat'] ?></td>
                    <td><?= $objet['quantiteDemande'] ?></td>
                    <td><?= $objet['nomProduit'] ?></td>
                    <td><?= $objet['villeNom'] ?></td>
                    <td><?= $objet['quantiteDonne'] ?></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </table>
</body>
</html>