<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/repositories/UserRepository.php';

try {
    $pdo = Flight::db();
    $repo = new UserRepository($pdo);

    // Test avec une valeur
    $name = "testuser";
    echo "Calling verifyLogin with name={$name}\n";
    $id = $repo->verifyLogin($name);
    echo "Result id: " . var_export($id, true) . "\n";
} catch (Throwable $e) {
    echo "Exception caught: " . get_class($e) . " - " . $e->getMessage() . "\n";
    echo "Trace:\n" . $e->getTraceAsString() . "\n";
}
