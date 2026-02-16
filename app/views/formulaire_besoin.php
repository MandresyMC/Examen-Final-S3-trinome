<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faire un don</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .ville-card {
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .ville-card.selected {
            border: 3px solid #28a745;
            box-shadow: 0 0 15px rgba(0,128,0,0.5);
            transform: scale(1.05);
        }
        .ville-card img {
            object-fit: cover;
            height: 200px;
            width: 100%;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="text-center mb-4">
        <h3>Choisissez une ville pour faire un don</h3>
    </div>

    <form action="/faire_don" method="POST">
        <input type="hidden" name="ville_id" id="ville_id">

        <div class="row g-4">
            <?php foreach ($villes as $ville) : ?>
                <div class="col-md-6">
                    <div class="card ville-card" data-id="<?= htmlspecialchars($ville['id']) ?>">
                    
                        <img src="/assets/1.jpeg" alt="<?= htmlspecialchars($ville['nom']) ?>">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= htmlspecialchars($ville['nom']) ?></h5>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success btn-lg" id="btn-don" disabled>Faire un don</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const villeCards = document.querySelectorAll('.ville-card');
    const villeIdInput = document.getElementById('ville_id');
    const btnDon = document.getElementById('btn-don');

    villeCards.forEach(card => {
        card.addEventListener('click', () => {
            // Retirer la sélection précédente
            villeCards.forEach(c => c.classList.remove('selected'));
            // Ajouter la sélection sur la carte cliquée
            card.classList.add('selected');
            // Remplir le champ caché pour le formulaire
            villeIdInput.value = card.dataset.id;
            // Activer le bouton Faire un don
            btnDon.disabled = false;
        });
    });
</script>

</body>
</html>
