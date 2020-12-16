<?php
//--------------------------------------------Admin------------------------------------

$router->post('/admin/settings', function () {
    $post = \App\Request::post();
    foreach ($post as $key=>$value) {
        \App\Settings::getInstance()->set($key, $value);
    }
    setSuccess('Настройки обновлены');
    redirect('/admin/settings');
});
$router->get('/admin/settings', function () {
    return new App\View\View('/admin/settings', ['title'=>"Настройки сайта"]);
});

//Users

$router->get('/admin/users', 'App\Controller\Admin\User@index');
$router->post('/admin/permissions', 'App\Controller\Admin\User@permissions');
$router->get('/admin/permissions', function () {
    if (!isset($_SESSION['user']) || !$_SESSION['user']->canDo(['VIEW_ADMIN', 'edit_user'], true)) {
        throw new \App\Exception\AccessDeniedException('Доступ запрещен!');
    }

    return new App\View\View(
        'admin\permissions',
        [
            'title' => "Права",
            'roles' => \App\Model\Role::with('permissions')->get(),
            'permissions' => \App\Model\Permission::with('roles')->get(),
        ]
    );
});


//Comments

$router->get('/admin/comments/moderate/*', function (int $id) {
    if (!isset($_SESSION['user']) || !$_SESSION['user']->canDo(['VIEW_ADMIN', 'moderate_comments'], true)) {
        throw new \App\Exception\AccessDeniedException('Доступ запрещен!');
    }

    $comment = \App\Model\Comment::find($id);

    if ($comment == null) {
        throw new \App\Exception\NotFoundException('Комментарий не найден или удален');
    }

    $comment->moderated = true;
    if ($comment->save()) {
        setSuccess('Комментарий одобрен');
        redirect($_SERVER['HTTP_REFERER']);
    } else {
        setError('Произошла ошибка, пожалуйста обновите страницу и попробуйте снова');
        redirect($_SERVER['HTTP_REFERER']);
    }
});
$router->get('/admin/comments/unmoderate/*', function (int $id) {
    if (!isset($_SESSION['user']) || !$_SESSION['user']->canDo(['VIEW_ADMIN', 'moderate_comments'], true)) {
        throw new \App\Exception\AccessDeniedException('Доступ запрещен!');
    }

    $comment = \App\Model\Comment::find($id);

    if ($comment == null) {
        throw new \App\Exception\NotFoundException('Комментарий не найден или удален');
    }

    $comment->moderated = false;
    if ($comment->save()) {
        setSuccess('Комментарий отправлен на модерацию');
        redirect($_SERVER['HTTP_REFERER']);
    } else {
        setError('Произошла ошибка, пожалуйста обновите страницу и попробуйте снова');
        redirect($_SERVER['HTTP_REFERER']);
    }
});
$router->get('/admin/comments', function () {
    if (!isset($_SESSION['user']) || !$_SESSION['user']->canDo(['VIEW_ADMIN', 'moderate_comments'], true)) {
        throw new \App\Exception\AccessDeniedException('Доступ запрещен!');
    }

    $paginate = \App\Request::get('perpage');
    $paginate = is_array($paginate) ? \App\Settings::getInstance()->get(
        'result_per_page',
        \App\Config::getInstance()->get('default.result_per_page')
    ) : $paginate;

    $page = \App\Request::get('page');
    $page = is_array($page) ? 1 : $page;

    if ($paginate != 'all') {
        $comments = \App\Model\Comment::where('moderated', false)->paginate($paginate, ['*'], 'page', $page);
    } else {
        $comments = \App\Model\Comment::all();
    }

    return new App\View\View('admin\comments_list', ['comments' => $comments, 'title' => "Новые комментарии"]);
});

//Pages
$router->get('/admin/static/force-delete/*', 'App\Controller\Admin\Article@forceDelete');
$router->get('/admin/static/soft-delete/*', 'App\Controller\Admin\Article@softDelete');
$router->get('/admin/static/restore/*', 'App\Controller\Admin\Article@restore');
$router->get('/admin/static/publish/*', 'App\Controller\Admin\Article@publish');
$router->get('/admin/static/unpublish/*', 'App\Controller\Admin\Article@unpublish');
$router->post('/admin/static/edit', 'App\Controller\Admin\Article@edit');
$router->get('/admin/static/edit/*', function (int $id) {
    if (!isset($_SESSION['user']) || !$_SESSION['user']->canDo(['view_admin', 'edit_articles'], true)) {
        throw new \App\Exception\AccessDeniedException('Доступ запрещен!');
    }

    return new App\View\View(
        'admin/post',
        [
            'title' => "Редактирование страницы",
            'pageClass' => 'admin',
            'article' => \App\Model\Post::find($id),
            'type' => 'page'
        ]
    );
});
$router->post('/admin/static/new', 'App\Controller\Admin\Article@add');

$router->get('/admin/static/new', function () {
    if (!isset($_SESSION['user']) || !$_SESSION['user']->canDo(['view_admin', 'create_articles'], true)) {
        throw new \App\Exception\AccessDeniedException('Доступ запрещен!');
    }
    return new App\View\View('admin/post', ['title' => "Новая страница", 'pageClass' => 'admin', 'type'=> 'page']);
});

$router->get('/admin/static', function () {
    $controller = new \App\Controller\Admin\ArticleController();
    return $controller->indexAction('page');
});


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

    return new App\View\View(
        'admin/post',
        [
            'title' => "Редактирование статьи",
            'pageClass' => 'admin',
            'article' => \App\Model\Post::find($id),
            'type' => 'post'
        ]
    );
});
$router->post('/admin/new', 'App\Controller\Admin\Article@add');

$router->get('/admin/new', function () {
    if (!isset($_SESSION['user']) || !$_SESSION['user']->canDo(['view_admin', 'create_articles'], true)) {
        throw new \App\Exception\AccessDeniedException('Доступ запрещен!');
    }
    return new App\View\View('admin/post', ['title' => "Новая статья", 'pageClass' => 'admin', 'type'=> 'post']);
});

$router->get('/admin', function () {
    $controller = new \App\Controller\Admin\ArticleController();
    return $controller->indexAction('post');
});
//$router->get('/admin', 'App\Controller\Admin\Article@index');

//------------------------Main--------------------------------------------------------------//
//User
$router->post('/subscribe', 'App\Controller\User@subscribe');

$router->get('/unsubscribe', 'App\Controller\User@unsubscribe');

$router->post('/registration', 'App\Controller\User@registration');

$router->get('/registration', function () {
    return new App\View\View(
        'registration',
        [
            'title' => 'Регистрация нового пользователя',
            'pageClass' => 'registration'
        ]
    );
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
    return new App\View\View('profile', ['user' => $_SESSION['user']]);
});

$router->post('/profile/update', 'App\Controller\User@update');

$router->get('/profile/*', function (int $userID) {
    $user = \App\Model\User::find($userID);
    if (!$user) {
        throw new \App\Exception\NotFoundException('Пользователь не найден!');
    }
    return new App\View\View('profile', ['user' => $user]);
});


///////////////
///
/////------------- Comments

$router->post('/comment/add/*', 'App\Controller\Comment@add');
$router->post('/comment/edit/*', 'App\Controller\Comment@edit');


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
    $paginate =  \App\Settings::getInstance()->get(
        'result_per_page',
        \App\Config::getInstance()->get('default.result_per_page')
    );

    $page = \App\Request::get('page');
    $page = is_array($page) ? 1 : $page;

    if ($paginate != 'all') {
        $articles = \App\Model\Post::where('type', 'post')->where('published', true)->orderByDesc('created_at')->paginate($paginate, ['*'], 'page', $page);
    } else {
        $articles = \App\Model\Post::here('type', 'post')->where('published', true)->orderByDesc('created_at')->get();
    }

    return new App\View\View('index', compact('articles'));
});

$router->get('/article/*', function (int $id) {
    $article = \App\Model\Post::find($id);
    $type = 'post';
    return new App\View\View('post', compact('article', 'type'));
});


$router->get('/page/*', function (int $id) {
    $article = \App\Model\Post::find($id);
    $type = 'page';
    return new App\View\View('post', compact('article', 'type'));
});
