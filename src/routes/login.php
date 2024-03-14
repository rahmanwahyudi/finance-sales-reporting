<?php
// File: src/routes/login.php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function ($app) {
    $app->get('/login', function (Request $request, Response $response) {
        ob_start();
        include __DIR__ . '/../views/login/loginview.php'; 
        $response->getBody()->write(ob_get_clean());
        return $response;
    });

    $app->post('/login', function (Request $request, Response $response) use ($app) { 
        $pdo = require __DIR__ . '/../db.php';
        $data = $request->getParsedBody();
        include __DIR__ . '/../models/loginmodel.php';
        $user = authenticateUser($pdo, $data['username'], $data['password']);

        if ($user) {
            $_SESSION['user'] = $user['username'];
            $_SESSION['user_fullName'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];
            return $response->withHeader('Location', '/dashboard')->withStatus(302);
        }

        return $response->withHeader('Location', '/login?error=invalid')->withStatus(302);
    });

    $app->get('/logout', function (Request $request, Response $response) {
        session_unset();
        session_destroy();
    
        return $response->withHeader('Location', '/login')->withStatus(302);
    });
};
