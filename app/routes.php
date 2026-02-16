<?php
session_start();
require_once __DIR__ . '/controllers/DonsController.php';
require_once __DIR__ . '/controllers/DashboardController.php';

require_once __DIR__ . '/controllers/BesoinRepository.php';
require_once __DIR__ . '/controllers/DashboardRepository.php';
require_once __DIR__ . '/controllers/DonsRepository.php';
require_once __DIR__ . '/controllers/StockDonsRepository.php';
require_once __DIR__ . '/controllers/VilleRepository.php';

Flight::route('GET /', function () {
    Flight::redirect('/formulaire_dons');
});

Flight::route('GET /formulaire_dons', ['DonsController', 'showFormulaireDons']);
