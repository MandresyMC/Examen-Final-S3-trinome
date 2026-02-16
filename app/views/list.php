<?php


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des villes</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        
        <div class="card shadow">
            <div class="card-header bg-primary text-white text-center">
                <h3 class="mb-0">Liste des villes et leurs besoins</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Ville</th>
                                <th>Besoin</th>
                                <th>Quantité</th>
                                <th></th>
                            </tr>
                        </thead>
                    
                        <tbody>
                            <?php foreach ($donnee as donne) { ?>
                                <tr>
                                    <td><?= $donne['nom'] ?></td>
                                    <td><?= $donne['besoin'] ?></td>
                                    <td><?= $donne['quantite'] ?></td>
                                    <td><a href="/dons/<?= $donne['id'] ?>" class="btn btn-sm btn-warning">faire un dons</a></td>
                                </tr>
                            <?php  } ?>   
                        </tbody>
                        
                    </table>
                </div>
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
