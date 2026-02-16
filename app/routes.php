<?php
session_start();
require_once __DIR__ . '/controllers/DonsController.php';
require_once __DIR__ . '/controllers/DashboardController.php';
require_once __DIR__ . '/controllers/BesoinController.php';
require_once __DIR__ . '/controllers/StockController.php';


require_once __DIR__ . '/repositories/BesoinRepository.php';
require_once __DIR__ . '/repositories/DashboardRepository.php';
require_once __DIR__ . '/repositories/DonsRepository.php';
require_once __DIR__ . '/repositories/StockDonsRepository.php';
require_once __DIR__ . '/repositories/VilleRepository.php';
require_once __DIR__ . '/repositories/CategorieRepository.php';

Flight::route('GET /', function () {
    Flight::redirect('/formulaire_dons');
});

Flight::route('GET /formulaire_besoin', ['BesoinController', 'showFormulaireBesoin']);
Flight::route('POST /formulaire_besoin', ['BesoinController', 'saveBesoin']);

Flight::route('GET /formulaire_stock', ['StockController', 'showFormulaireStock']);
Flight::route('POST /formulaire_stock', ['StockController', 'saveStock']);

Flight::route('GET /formulaire_dons', ['DonsController', 'showFormulaireDons']);
Flight::route('GET /dashboard', ['DashboardController', 'showDashboard']);