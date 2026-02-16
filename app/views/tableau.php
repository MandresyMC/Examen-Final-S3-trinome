<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
</head>
<body>

<div class="card shadow">
    <div class="card-header bg-success text-white text-center">
        <h3 class="mb-0">Tableau de bord</h3>
    </div>

    <div class="card-body">

        <?php if (empty($achats)) : ?>
            <p class="text-center">Aucun achat</p>
        <?php else : ?>
            <table border="1" width="100%" cellpadding="8">
                <thead>
                    <tr>
                        <th>Ville</th>
                        <th>Stock</th>
                        <th>Don</th>
                        <th>Quantité</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($achats as $achat) : ?>
                        <tr>
                            <td><?= $achat['idVille'] ?></td>
                            <td><?= $achat['idStock'] ?></td>
                            <td><?= $achat['idDon'] ?></td>
                            <td><?= $achat['quantite'] ?></td>
                            <td><?= $achat['created_at'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

    </div>
</div>

</body>
</html>
