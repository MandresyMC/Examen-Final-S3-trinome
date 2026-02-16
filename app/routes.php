<?php
session_start();
require_once __DIR__ . '/controllers/LoginController.php';
require_once __DIR__ . '/controllers/AccueilController.php';
require_once __DIR__ . '/controllers/EchangeController.php';
require_once __DIR__ . '/controllers/ConfirmationEchangeController.php';
require_once __DIR__ . '/repositories/UserRepository.php';
require_once __DIR__ . '/repositories/ObjetRepository.php';
require_once __DIR__ . '/repositories/EchangeRepository.php';

Flight::route('GET /', function () {
    Flight::redirect('/login');
});

Flight::route('GET /login', ['LoginController', 'showLogin']);
Flight::route('POST /login', ['LoginController', 'postLogin']);

Flight::route('GET /accueil', ['AccueilController', 'showAccueil']);

Flight::route('GET /echange', ['EchangeController', 'showEchange']);
Flight::route('GET /echange/envoi_echange', ['EchangeController', 'createEchange']);

Flight::route('GET /confirmation_echange', ['ConfirmationEchangeController', 'showConfirmationEchange']);
Flight::route('GET /confirmation_echange/decline', ['ConfirmationEchangeController', 'declineEchange']); // decline
Flight::route('GET /confirmation_echange/accept', ['ConfirmationEchangeController', 'acceptEchange']); // accept

Flight::route('GET /deconnexion', function() {
    session_destroy();
    Flight::redirect('/login');
});