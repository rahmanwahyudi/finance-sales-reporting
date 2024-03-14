<?php
// File: src/routes/dashboard.php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function ($app) {
    $app->get('/dashboard', function (Request $request, Response $response) {

        if (!isset($_SESSION['user'])) {
            return $response->withHeader('Location', '/login')->withStatus(302);
        }

        ob_start();
        include __DIR__ . '/../views/dashboard/dashboardview.php'; 
        $response->getBody()->write(ob_get_clean());
        return $response;
    });
};
