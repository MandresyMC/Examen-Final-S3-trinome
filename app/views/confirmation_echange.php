<?php
    $current_user = 2;
    $success = $success;
    $allConfirmEchange = $allConfirmEchange;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation Echange</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
</head>
<body class="">
    <?php include('header/header.php') ?>

    <div class="container-fluid">
        <h1 class="py-4">Liste des invitations</h1>

        <?php if ($success != null) { ?>
            <p class="alert alert-success"><?= $success ?></p>
        <?php } ?>

        <?php if (empty($allConfirmEchange)) { ?>
            <p class="alert alert-info">Pas d'invitation pour l'instant</p>
        <?php } else {
            foreach ($allConfirmEchange as $echange) { ?>
                <div class="card p-4 w-50">
                    <p><?= $echange['objet1_titre'] ?> -> <?= $echange['objet2_titre'] ?></p>
                    <div class="d-flex">
                        <a class="btn btn-success w-50 me-2" href="confirmation_echange/accept?idEchange=<?= $echange['id'] ?>">Accepter</a>
                        <a class="btn btn-outline-danger w-50" href="confirmation_echange/decline?current_user=<?= $current_user ?>&idEchange=<?= $echange['id'] ?>">Decliner</a>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</body>
</html>