<?php
session_start();
require_once __DIR__ . '/controllers/DonsController.php';
require_once __DIR__ . '/controllers/DashboardController.php';
require_once __DIR__ . '/controllers/BesoinController.php';
require_once __DIR__ . '/controllers/StockController.php';
require_once __DIR__ . '/controllers/AchatController.php';
require_once __DIR__ . '/controllers/VenteController.php';
require_once __DIR__ . '/controllers/RecapitulationController.php';
require_once __DIR__ . '/controllers/ReinitialiserController.php';
require_once __DIR__ . '/controllers/CommissionController.php';
require_once __DIR__ . '/controllers/ProduitController.php';

require_once __DIR__ . '/repositories/BesoinRepository.php';
require_once __DIR__ . '/repositories/DashboardRepository.php';
require_once __DIR__ . '/repositories/DonsRepository.php';
require_once __DIR__ . '/repositories/StockDonsRepository.php';
require_once __DIR__ . '/repositories/VilleRepository.php';
require_once __DIR__ . '/repositories/CategorieRepository.php';
require_once __DIR__ . '/repositories/ProduitRepository.php';
require_once __DIR__ . '/repositories/AchatRepository.php';
require_once __DIR__ . '/repositories/VenteRepository.php';
require_once __DIR__ . '/repositories/ReinitialiserRepository.php';
require_once __DIR__ . '/repositories/CommissionRepository.php';



Flight::route('GET /', function () {
    Flight::redirect('/dashboard');
});

Flight::route('GET /formulaire_besoin', ['BesoinController', 'showFormulaireBesoin']);
Flight::route('POST /formulaire_besoin', ['BesoinController', 'saveBesoin']);

Flight::route('GET /formulaire_stock', ['StockController', 'showFormulaireStock']);
Flight::route('POST /formulaire_stock', ['StockController', 'saveStock']);


Flight::route('GET /dashboard', ['DashboardController', 'showDashboard']);

Flight::route('GET /dons', ['DonsController', 'showDons']);
Flight::route('GET /formulaire_dons', ['DonsController', 'showFormulaireDons']);
Flight::route('POST /ajout_dons', ['DonsController', 'createDon']);

Flight::route('GET /achat', ['AchatController', 'showVilleAchat']);
Flight::route('GET /formulaire_achat', ['AchatController', 'showFormulaireAchat']);
Flight::route('POST /formulaire_achat', ['AchatController', 'saveAchat']);

Flight::route('GET /achat', ['AchatController', 'showVilleAchat']);
Flight::route('POST /formulaire_achat', ['VenteController', 'saveVente']);

Flight::route('GET /vente', ['VenteController', 'showVilleDons']);
Flight::route('POST /vente/create', ['VenteController', 'createVente']);

Flight::route('GET /recapitulation', function () {
    Flight::render('recapitulation');
});
Flight::route('GET /recapitulation/actualiser', ['RecapitulationController', 'getAll']);

Flight::route('GET /reinitialiser', function () {
    Flight::render('reinitialiser');
});

Flight::route('GET /commission', ['CommissionController', 'showFormulaireCommission']);
Flight::route('POST /commission', ['CommissionController', 'updateCommission']);

Flight::route('GET /formulaire_produit', function() {
    Flight::render('formulaire_produit.php');
});
Flight::route('POST /formulaire_produit', ['ProduitController', 'saveProduit']);