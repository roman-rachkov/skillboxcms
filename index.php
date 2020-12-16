<?php


error_reporting(E_ALL);
ini_set('display_errors', true);

require_once 'bootstrap.php';

$router = new \App\Router();

require_once 'routes.php';

$application = \App\Application::getInstance();
$application->setRouter($router);

startSession();

$application->run();

printDebug();
