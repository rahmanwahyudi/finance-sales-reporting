<?php
// File: src/routes/master-am.php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function ($app) {
    $app->get('/master-am', function (Request $request, Response $response) {

        if (!isset($_SESSION['user'])) {
            return $response->withHeader('Location', '/login')->withStatus(302);
        }

        // Include the database connection
        $pdo = require __DIR__ . '/../db.php'; // Ensure this path is correct

        // Fetch account managers from the database
        $sql = "SELECT id, full_name, nick_name, email, phone_number FROM account_managers";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $accountManagers = $stmt->fetchAll();

        ob_start();
        include __DIR__ . '/../views/master-am/master-am-list.php';
        $response->getBody()->write(ob_get_clean());
        return $response;
    });

    $app->post('/master-am/add', function (Request $request, Response $response) use ($app) {
        if (!isset($_SESSION['user'])) {
            return $response->withHeader('Location', '/login')->withStatus(302);
        }

        $pdo = require __DIR__ . '/../db.php'; // Ensure this path is correct
        $data = $request->getParsedBody();

        // Basic data sanitization (should be expanded for production)
        $full_name = htmlspecialchars($data['full_name']);
        $nick_name = htmlspecialchars($data['nick_name']);
        $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
        $phone_number = htmlspecialchars($data['phone_number']);

        // Basic validation (should be expanded for production)
        if (!empty($full_name) && !empty($email)) {
            $sql = "INSERT INTO account_managers (full_name, nick_name, email, phone_number) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$full_name, $nick_name, $email, $phone_number]);

            // Redirect to the list after adding
            return $response->withHeader('Location', '/master-am')->withStatus(302);
        } else {
            // Handle validation error (basic example)
            echo "Validation failed"; // Consider using session flash messages or a similar approach for user feedback
            return $response;
        }
    });

    $app->post('/master-am/delete', function (Request $request, Response $response) {
        $data = $request->getParsedBody();
        $id = $data['id'];

        $pdo = require __DIR__ . '/../db.php';
        $sql = "DELETE FROM account_managers WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        return $response->withHeader('Location', '/master-am')->withStatus(302);
    });

    $app->post('/master-am/edit', function (Request $request, Response $response) use ($app) {
        $data = $request->getParsedBody();

        // Make sure you have a connection to your database
        $pdo = require __DIR__ . '/../db.php';

        // Prepare your SQL statement
        $sql = "UPDATE account_managers SET full_name = ?, nick_name = ?, email = ?, phone_number = ? WHERE id = ?";

        // Execute the statement with the data
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$data['full_name'], $data['nick_name'], $data['email'], $data['phone_number'], $data['id']]);

        // Redirect back to the list view
        return $response->withHeader('Location', '/master-am')->withStatus(302);
    });
};
