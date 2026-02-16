<?php $user_nom = $_SESSION['nom'] ?? 'Utilisateur inconnu'; ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/accueil">
            <i class="bi bi-arrow-left-right"></i> Takalo
        </a>
        <a href="/confirmation_echange" class="text-white ms-5 link-offset-2 link-underline link-underline-opacity-0">Confirmation d'echange</a>
        <a href="/deconnexion" class="btn btn-outline-light ms-auto me-2">Déconnexion</a>
        <div class="navbar-text text-white">
            Bienvenue, <strong><?= ($user_nom) ?></strong>
        </div>
    </div>
</nav>