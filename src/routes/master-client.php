<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function ($app) {
    // List clients
    $app->get('/master-client', function (Request $request, Response $response) {
        if (!isset($_SESSION['user'])) {
            return $response->withHeader('Location', '/login')->withStatus(302);
        }

        $pdo = require __DIR__ . '/../db.php';
        $sql = "SELECT mc.id, mc.name, mc.email, mc.phone_number, mc.address, 
                am.full_name AS account_manager, ms.status, mcur.code AS currency, 
                mcat.name AS category, mdog.category_name AS dog
                FROM master_client mc
                LEFT JOIN account_managers am ON mc.account_manager_id = am.id
                LEFT JOIN master_status ms ON mc.status_id = ms.id
                LEFT JOIN master_currency mcur ON mc.currency_id = mcur.id
                LEFT JOIN master_category mcat ON mc.category_id = mcat.id
                LEFT JOIN master_dog mdog ON mc.dog_id = mdog.id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $clients = $stmt->fetchAll();

        ob_start();
        include __DIR__ . '/../views/master-client/master-client-list.php';
        $response->getBody()->write(ob_get_clean());
        return $response;
    });

    // Add client
    $app->post('/master-client/add', function (Request $request, Response $response) {
        if (!isset($_SESSION['user'])) {
            return $response->withHeader('Location', '/login')->withStatus(302);
        }

        $pdo = require __DIR__ . '/../db.php';
        $data = $request->getParsedBody();
        
        // Add data sanitization and validation here
        $sql = "INSERT INTO master_client (name, email, phone_number, address, account_manager_id, status_id, currency_id, category_id, dog_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $data['name'], $data['email'], $data['phone_number'], $data['address'], 
            $data['account_manager_id'], $data['status_id'], $data['currency_id'], 
            $data['category_id'], $data['dog_id']
        ]);

        return $response->withHeader('Location', '/master-client')->withStatus(302);
    });

    // Edit client
    $app->post('/master-client/edit', function (Request $request, Response $response) {
        if (!isset($_SESSION['user'])) {
            return $response->withHeader('Location', '/login')->withStatus(302);
        }

        $pdo = require __DIR__ . '/../db.php';
        $data = $request->getParsedBody();

        // Add data sanitization and validation here
        $sql = "UPDATE master_client SET name = ?, email = ?, phone_number = ?, address = ?, account_manager_id = ?, status_id = ?, currency_id = ?, category_id = ?, dog_id = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $data['name'], $data['email'], $data['phone_number'], $data['address'], 
            $data['account_manager_id'], $data['status_id'], $data['currency_id'], 
            $data['category_id'], $data['dog_id'], $data['id']
        ]);

        return $response->withHeader('Location', '/master-client')->withStatus(302);
    });

    // Delete client
    $app->post('/master-client/delete', function (Request $request, Response $response) {
        if (!isset($_SESSION['user'])) {
            return $response->withHeader('Location', '/login')->withStatus(302);
        }

        $pdo = require __DIR__ . '/../db.php';
        $data = $request->getParsedBody();

        $sql = "DELETE FROM master_client WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$data['id']]);

        return $response->withHeader('Location', '/master-client')->withStatus(302);
    });
};
