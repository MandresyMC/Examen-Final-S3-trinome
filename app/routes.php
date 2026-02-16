<?php
session_start();
require_once __DIR__ . '/controllers/DonsController.php';
require_once __DIR__ . '/controllers/DashboardController.php';

require_once __DIR__ . '/repositories/BesoinRepository.php';
require_once __DIR__ . '/repositories/DashboardRepository.php';
require_once __DIR__ . '/repositories/DonsRepository.php';
require_once __DIR__ . '/repositories/StockDonsRepository.php';
require_once __DIR__ . '/repositories/VilleRepository.php';

Flight::route('GET /', function () {
    Flight::redirect('/formulaire_dons');
});

Flight::route('GET /formulaire_dons', ['DonsController', 'showFormulaireDons']);
Flight::route('GET /dashboard', ['DashboardController', 'showDashboard']);

Flight::route('POST /dons', ['DonsController', 'createDon']);