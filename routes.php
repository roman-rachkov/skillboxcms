<?php
//--------------------------------------------Admin------------------------------------

$router->post('/admin/settings', 'App\Controller\Admin\Settings@update');
$router->get('/admin/settings', 'App\Controller\Admin\Settings@index');

//Users

$router->get('/admin/users/edit/*', 'App\Controller\Admin\User@edit');
$router->post('/admin/users/update', 'App\Controller\Admin\User@update');
$router->get('/admin/users', 'App\Controller\Admin\User@index');
$router->post('/admin/permissions', 'App\Controller\Admin\User@permissions');
$router->get('/admin/permissions', 'App\Controller\Admin\User@viewPermissions');


//Comments

$router->get('/admin/comments/moderate/*', 'App\Controller\Admin\Comment@moderate');
$router->get('/admin/comments/unmoderate/*', 'App\Controller\Admin\Comment@unmoderate');
$router->get('/admin/comments', 'App\Controller\Admin\Comment@index');

//articles & pages
$router->get('/admin/*/force-delete/*', 'App\Controller\Admin\Article@forceDelete');
$router->get('/admin/*/soft-delete/*', 'App\Controller\Admin\Article@softDelete');
$router->get('/admin/*/restore/*', 'App\Controller\Admin\Article@restore');
$router->get('/admin/*/publish/*', 'App\Controller\Admin\Article@publish');
$router->get('/admin/*/unpublish/*', 'App\Controller\Admin\Article@unpublish');
$router->post('/admin/*/edit', 'App\Controller\Admin\Article@update');
$router->get('/admin/*/edit/*', 'App\Controller\Admin\Article@edit');
$router->post('/admin/*/new', 'App\Controller\Admin\Article@create');
$router->get('/admin/*/new', 'App\Controller\Admin\Article@add');
$router->get('/admin/*', 'App\Controller\Admin\Article@index');

//------------------------Main--------------------------------------------------------------//
//User
$router->post('/subscribe', 'App\Controller\User@subscribe');
$router->get('/unsubscribe', 'App\Controller\User@unsubscribe');
$router->post('/registration', 'App\Controller\User@registration');
$router->get('/registration', 'App\Controller\User@viewRegistration');

$router->post('/login', 'App\Controller\User@login');

$router->get('/logout', 'App\Controller\User@logout');

$router->get('/login', 'App\Controller\User@viewLogin');

$router->get('/profile', 'App\Controller\User@profile');

$router->post('/profile/*', 'App\Controller\User@update');

$router->get('/profile/*', 'App\Controller\User@profile');

/////------------- Comments

$router->post('/comment/add/*', 'App\Controller\Comment@add');
$router->post('/comment/edit/*', 'App\Controller\Comment@edit');

$router->get('/', 'App\Controller\Article@index');

$router->get('/article/*', 'App\Controller\Article@single');
$router->get('/page/*', 'App\Controller\Article@single');

