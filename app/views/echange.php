<?php
    $current_user = $current_user;
    $objetChoisi = $objetChoisi;
    $allObjets = $allObjets;
    $success = $success;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Echange</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
</head>
<body class="">
    <?php include('header/header.php') ?>

    <div class="container-fluid">
        <h1 class="pt-4">Objet choisi pour l'échange</h1>

        <?php if (isset($error)) { ?>
            <p class="alert alert-danger"><?= $error ?></p>
        <?php } ?>

        <?php if (!$objetChoisi) { ?>
            <p class="alert alert-info">L'objet choisi n'existe pas ou n'a pas été trouvé</p>
        <?php } else { ?>
            <div class="card mx-auto mt-3 w-50 p-2">
                <img src="" class="card-img-top" alt="">
                <div class="card-body">
                    <h5 class="card-title mb-3"><?= $objetChoisi['titre'] ?></h5>
                    <p class="card-text"><?= $objetChoisi['description'] ?></p>
                </div>
            </div>
        <?php } ?>

        <h1 class="mt-5 mb-3">Objet à echanger</h1>
        <?php if (isset($success)) { ?>
            <p class="alert alert-success"><?= $success ?></p>
        <?php } ?>
        <?php if (empty($allObjets) || $allObjets == null) { ?>
            <p class="alert alert-info">Objets non trouvés</p>
        <?php } else { ?>
            <div class="row">
                <?php foreach ($allObjets as $objet) {
                    if ($objet['idUser'] == $current_user) { ?>
                        <div class="col-lg-4">
                            <div class="card p-2">
                                <img src="" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 class="card-title mb-3"><?= $objet['titre'] ?></h5>
                                    <p class="card-text"><?= $objet['description'] ?></p>
                                    <form action="/echange/envoi_echange" method="get">
                                        <input type="hidden" name="idObjet1" value="<?= $objetChoisi['id'] ?>">
                                        <input type="hidden" name="idObjet2" value="<?= $objet['id'] ?>">
                                        <button class="btn btn-primary w-100">Echanger</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php }
                } ?>
            </div>
        <?php } ?>
    </div>
</body>
</html>