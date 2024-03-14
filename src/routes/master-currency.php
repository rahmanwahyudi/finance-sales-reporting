<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function ($app) {
    // List currencies
    $app->get('/master-currency', function (Request $request, Response $response) {
        if (!isset($_SESSION['user'])) {
            return $response->withHeader('Location', '/login')->withStatus(302);
        }

        $pdo = require __DIR__ . '/../db.php';
        $sql = "SELECT id, code, name, symbol FROM master_currency";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $currencies = $stmt->fetchAll();

        ob_start();
        include __DIR__ . '/../views/master-currency/master-currency-list.php';
        $response->getBody()->write(ob_get_clean());
        return $response;
    });

    // Add currency
    $app->post('/master-currency/add', function (Request $request, Response $response) {
        // Similar to your add route for master-am
    });

    // Edit currency
    $app->post('/master-currency/edit', function (Request $request, Response $response) {
        // Similar to your edit route for master-am
    });

    // Delete currency
    $app->post('/master-currency/delete', function (Request $request, Response $response) {
        // Similar to your delete route for master-am
    });
};
