<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulation - Besoins & Dons</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/recapitulation.css">
</head>
<body>
    <div class="container-fluid">
        <div class="header-section">
            <h1 class="main-title">Récapitulation Humanitaire</h1>
            <p class="subtitle">Suivi en temps réel des besoins et des contributions</p>
            <button class="btn btn-refresh" id="actualiser">
                <span class="refresh-icon">↻</span>
                Actualiser les données
            </button>
        </div>

        <div class="stats-cards">
            <div class="stat-card besoins-card">
                <div class="stat-icon">B</div>
                <div class="stat-content">
                    <div class="stat-label">Total des besoins</div>
                    <h3 id="totalMontant" class="stat-value">—</h3>
                </div>
            </div>
            <div class="stat-card dons-card">
                <div class="stat-icon">D</div>
                <div class="stat-content">
                    <div class="stat-label">Total des dons</div>
                    <h3 id="totalMontantDons" class="stat-value">—</h3>
                </div>
            </div>
            <div class="stat-card difference-card">
                <div class="stat-icon">Δ</div>
                <div class="stat-content">
                    <div class="stat-label">Différence</div>
                    <h3 id="difference" class="stat-value">—</h3>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-6 mb-4">
                <div class="section-header besoins-header">
                    <h2>Besoins Identifiés</h2>
                    <span class="badge" id="besoins-count">0</span>
                </div>
                <div id="besoins" class="cards-container"></div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="section-header dons-header">
                    <h2>Dons Reçus</h2>
                    <span class="badge" id="dons-count">0</span>
                </div>
                <div id="dons" class="cards-container"></div>
            </div>
        </div>
    </div>

    <div class="loading-overlay" id="loading">
        <div class="spinner"></div>
        <p>Chargement des données...</p>
    </div>

    <script src="js/recapitulation.js"></script>
</body>
</html>