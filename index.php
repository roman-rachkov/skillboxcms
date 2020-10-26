<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

require_once 'bootstrap.php';

$router = new \App\Router();

$router->get('/admin', function () {
    if(!isset($_SESSION['user']) || !$_SESSION['user']->canDo('view_admin')){
        throw new \App\Exception\AccessDeniedException('Доступ запрещен!');
    }
    return new App\View\View('admin/post-list', ['title' => "Список постов", 'pageClass' => 'admin', 'pageClass' => 'admin']);
});

$router->post('/registration', 'App\Controller\User@registration');
$router->get('/registration', function () {
    return new App\View\View('registration', ['title' => 'Регистрация нового пользователя', 'pageClass' => 'registration']);
});
$router->post('/login', 'App\Controller\User@login');
$router->get('/logout', function () {
    session_destroy();
    redirect();
});
$router->get('/login', function () {
    return new App\View\View('login', ['title' => 'Вход на сайт', 'pageClass' => 'login']);
});
$router->get('/category', "App\Controller\Category@index");
$router->get('/category/view', function () {
//    $nodes = App\Model\Category::All()->toTree();
//
//    travers($nodes);
//
////    $traverse = function ($categories, $prefix = '-') use (&$traverse) {
////        foreach ($categories as $category) {
////            echo nl2br(PHP_EOL.$prefix.' '.$category->name);
////
////            $traverse($category->children, $prefix.'-');
////        }
////    };
});
$router->get('/', "App\Controller\Article@index");
$router->get('/*', "App\Controller\Article@single");

$application = new \App\Application($router);

startSession();

$application->run();

printDebug();
