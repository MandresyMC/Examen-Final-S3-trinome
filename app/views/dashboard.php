
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>liste des besoins des villes et dons attribue</h1>
    
    <table>
        <tr>
            <th>idCat</th>
            <th>quantiteDemande</th>
            <th>nomProduit</th>
            <th>idVille</th>
            <th>quantiteDonne</th>
        </tr>

        <?php foreach ($allObjets as $objet) { ?>
            <tr>
                <td><?= $objet['idCat'] ?></td>
                <td><?= $objet['quantiteDemande'] ?></td>
                <td><?= $objet['nomProduit'] ?></td>
                <td><?= $objet['idVille'] ?></td>
                <td><?= $objet['quantiteDonne'] ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>