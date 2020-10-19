<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

require_once 'bootstrap.php';

$router = new \App\Router();


$router->post('/registration', 'App\Controller\User@registration');
$router->get('/registration', function (){
    return new App\View\View('registration', ['title' => 'Регистрация нового пользователя', 'pageClass' => 'registration']);
});
$router->get('/category', "App\Controller\Category@index");
$router->get('/category/view', function () {
    $nodes = App\Model\Category::All()->toTree();

    travers($nodes);

//    $traverse = function ($categories, $prefix = '-') use (&$traverse) {
//        foreach ($categories as $category) {
//            echo nl2br(PHP_EOL.$prefix.' '.$category->name);
//
//            $traverse($category->children, $prefix.'-');
//        }
//    };

});
$router->get('/', "App\Controller\Article@index");
$router->get('/*', "App\Controller\Article@single");

$application = new \App\Application($router);


$application->run();

printDebug();
