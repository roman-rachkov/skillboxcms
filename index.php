<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

require_once 'bootstrap.php';

$router = new \App\Router();

//--------------------------------------------Admin------------------------------------
//Articles
$router->get('/admin/force-delete/*', 'App\Controller\Admin\Article@forceDelete');
$router->get('/admin/soft-delete/*', 'App\Controller\Admin\Article@softDelete');
$router->get('/admin/restore/*', 'App\Controller\Admin\Article@restore');
$router->get('/admin/publish/*', 'App\Controller\Admin\Article@publish');
$router->get('/admin/unpublish/*', 'App\Controller\Admin\Article@unpublish');
$router->post('/admin/edit', 'App\Controller\Admin\Article@edit');
$router->get('/admin/edit/*', function (int $id) {
    if (!isset($_SESSION['user']) || !$_SESSION['user']->canDo(['view_admin', 'edit_articles'], true)) {
        throw new \App\Exception\AccessDeniedException('Доступ запрещен!');
    }

    return new App\View\View('admin/post',
        [
            'title' => "Редактирование статьи",
            'pageClass' => 'admin',
            'article' => \App\Model\Post::find($id)
        ]);
});
$router->post('/admin/new', 'App\Controller\Admin\Article@add');

$router->get('/admin/new', function () {
    if (!isset($_SESSION['user']) || !$_SESSION['user']->canDo(['view_admin', 'create_articles'], true)) {
        throw new \App\Exception\AccessDeniedException('Доступ запрещен!');
    }
    return new App\View\View('admin/post', ['title' => "Новая статья", 'pageClass' => 'admin']);
});

$router->get('/admin', 'App\Controller\Admin\Article@index');

//------------------------Main--------------------------------------------------------------//
//User
$router->post('/subscribe', 'App\Controller\User@subscribe');

$router->post('/unsubscribe', 'App\Controller\User@unsubscribe');

$router->post('/registration', 'App\Controller\User@registration');

$router->get('/registration', function () {
    return new App\View\View('registration',
        [
            'title' => 'Регистрация нового пользователя',
            'pageClass' => 'registration'
        ]);
});

$router->post('/login', 'App\Controller\User@login');

$router->get('/logout', function () {
    session_destroy();
    redirect();
});

$router->get('/login', function () {
    return new App\View\View('login', ['title' => 'Вход на сайт', 'pageClass' => 'login']);
});

$router->get('/profile', function () {
    if (!isset($_SESSION['user'])) {
        throw new \App\Exception\NotFoundException('Пользователь не найден!');
    }
    return new App\View\View('profile', ['title' => 'Профиль пользователя ' . $_SESSION['user']->username, 'user' => $_SESSION['user']]);
});

$router->get('/profile/*', function (int $userID) {
    $user = \App\Model\User::find($userID);
    if (!$user) {
        throw new \App\Exception\NotFoundException('Пользователь не найден!');
    }
    return new App\View\View('profile', ['title' => 'Профиль пользователя ' . $user->username, 'user' => $user]);
});


///////////////
///
/////------------- Comments

$router->post('/comment/add/*', 'App\Controller\Comment@add');


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


$router->get('/', function () {
    $articles = \App\Model\Post::where('type', 'post')->where('published', true)->paginate(\App\Config::getInstance()->get('default.result_per_page'));
    return new App\View\View('index', compact('articles'));
});

$router->get('/article/*', function (int $id) {
    $article = \App\Model\Post::find($id);
    return new App\View\View('post', compact('article'));
});

$application = \App\Application::getInstance();
$application->setRouter($router);

startSession(350000);

$application->run();

printDebug();
