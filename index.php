<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

require_once 'bootstrap.php';

$router = new \App\Router();


$router->get('/category', "App\Controller\Category@index");
$router->get('/category/view', function () {
    debug(\App\Model\Category::All());
});
$router->get('/', "App\Controller\Article@index");
$router->get('/*', "App\Controller\Article@single");

$application = new \App\Application($router);


$application->run();

printDebug();
