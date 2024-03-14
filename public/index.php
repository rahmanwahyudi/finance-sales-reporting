<?php

session_start();
error_reporting(E_ALL & ~E_DEPRECATED);

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Slim\Factory\AppFactory;
use Slim\Exception\HttpNotFoundException;

require __DIR__ . '/../vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

//access environment variables using $_ENV or getenv()
$dbHost = $_ENV['DB_HOST'];
$dbName = $_ENV['DB_NAME'];
$dbUser = $_ENV['DB_USER'];
$dbPass = $_ENV['DB_PASS'];

$app = AppFactory::create();

// Register routes
$app->get('/', function (Request $request, Response $response) {
    if (isset($_SESSION['user'])) {
        // User is logged in, redirect to dashboard
        return $response->withHeader('Location', '/dashboard')->withStatus(302);
    } else {
        // User is not logged in, redirect to login
        return $response->withHeader('Location', '/login')->withStatus(302);
    }
});

(require __DIR__ . '/../src/routes/login.php')($app);
(require __DIR__ . '/../src/routes/dashboard.php')($app);
(require __DIR__ . '/../src/routes/master-am.php')($app);
(require __DIR__ . '/../src/routes/master-currency.php')($app);
(require __DIR__ . '/../src/routes/master-client.php')($app);

// Custom Not Found Handler
$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorHandler = $errorMiddleware->getDefaultErrorHandler();
$errorHandler->forceContentType('text/plain');
$errorMiddleware->setErrorHandler(HttpNotFoundException::class, function ($request, $exception, $displayErrorDetails, $logErrors, $logErrorDetails) {
    $response = new \Slim\Psr7\Response(); 
    $response->getBody()->write('Route not registered!'); 
    return $response->withStatus(404);
});

$app->run();