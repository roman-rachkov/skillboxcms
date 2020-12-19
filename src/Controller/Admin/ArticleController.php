<?php

namespace App\Controller\Admin;

use App\Config;
use App\Exception\AccessDeniedException;
use App\Model\Post;
use App\Model\User;
use App\Request;
use App\Settings;
use App\Validators\ArticleValidator;
use App\View\View;

class ArticleController extends BaseController
{
    public function indexAction(string $t): View
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']->canDo('edit_articles')) {
            throw new AccessDeniedException('Доступ запрещен!');
        }

        $type = Request::get('type');
        $type = is_array($type) ? 'all' : $type;

        $posts = null;
        if ($type == 'trashed') {
            $posts = Post::onlyTrashed();
        } elseif ($type == 'unpublished') {
            $posts = Post::where('published', false);
        } elseif ($type == 'published') {
            $posts = Post::where('published', true);
        }
        $posts = $posts ? $posts->where('type', $t) : Post::where('type', $t);

        $paginate = Request::get('perpage');
        $paginate = is_array($paginate) ?
            Settings::getInstance()->get('result_per_page', Config::getInstance()->get('default.result_per_page'))
            : $paginate;

        $page = Request::get('page');
        $page = is_array($page) ? 1 : $page;

        $posts = $posts->orderByDesc('created_at');

        if ($paginate != 'all') {
            $posts = $posts->paginate($perPage = 15, ['*'], 'page', $page)->setPath('/admin');
        } else {
            $posts = $posts->all();
        }
        return new View(
            'admin/post_list',
            [
                'title' => "Список " . ($t == 'post' ? 'статей' : 'страниц'),
                'pageClass' => 'admin',
                'articles' => $posts,
                'type' => $t
            ]
        );
    }

    public function createAction(string $t): View
    {
        if (!$_SESSION['user']->canDo('create_articles')) {
            throw new AccessDeniedException('Доступ запрещен');
        }

        $post = Request::post();

        $validator = new ArticleValidator($post);

        if ($validator->validate()) {
            $article = new Post();
            $article->title = $post['title'];
            $article->text = $post['text'];
            $article->type = $post['type'];

            $image = tryToUploadFile('image', ($post['type'] == 'post' ? 'articles' : 'pages'));
            if ($image) {
                $article->img_src = DIRECTORY_SEPARATOR . ($post['type'] == 'post' ? 'articles' : 'pages') . DIRECTORY_SEPARATOR . $image['name'];
            }
            if ($_SESSION['user']->articles()->save($article)) {
                setSuccess(($post['type'] == 'post' ? 'Статья' : 'Страница') . ' успешно создана');
                if ($post['type'] == 'post') {
                    foreach (User::where('subscribed', true)->get() as $user) {
                        sendMailToSubscribers($user->email, $article);
                    }
                }
                redirect(($post['type'] == 'post' ? '/article/' : '/page/') . $article->id);
            } else {
                setError('Что то пошло не так');
            }
        }

        return new View(
            '/admin/post',
            ['title' => $post['type'] == 'post' ? 'Новая статья' : 'Новая странциа',
                'errors' => $validator->errors(),
                'request' => $post]
        );
    }

    public function addAction(string $t)
    {
        if (!$_SESSION['user']->canDo('create_articles')) {
            throw new AccessDeniedException('Доступ запрещен!');
        }
        return new View('admin/post', ['title' => "Новая статья", 'pageClass' => 'admin', 'type' => $t]);
    }

    public function editAction(string $t, int $id)
    {
        if (!$_SESSION['user']->canDo('edit_articles')) {
            throw new \App\Exception\AccessDeniedException('Доступ запрещен!');
        }

        return new View(
            'admin/post',
            [
                'title' => "Редактирование статьи",
                'pageClass' => 'admin',
                'article' => \App\Model\Post::find($id),
                'type' => 'post'
            ]
        );
    }

    public function updateAction(string $t): View
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']->canDo('edit_articles')) {
            throw new AccessDeniedException('Доступ запрещен');
        }

        $post = Request::post();

        $validator = new ArticleValidator($post);

        if ($validator->validate()) {
            $article = Post::find($post['id']);
            $article->title = $post['title'];
            $article->text = $post['text'];
            $article->type = $post['type'];

            $image = tryToUploadFile('image', ($post['type'] == 'post' ? 'articles' : 'pages'));
            if ($image) {
                $article->img_src = DIRECTORY_SEPARATOR . ($post['type'] == 'post' ? 'articles' : 'pages') . DIRECTORY_SEPARATOR . $image['name'];
            }
            if ($_SESSION['user']->articles()->save($article)) {
                setSuccess(($post['type'] == 'post' ? 'Статья' : 'Страница') . ' успешно обновлена');
                redirect(($post['type'] == 'post' ? '/article/' : '/page/') . $article->id);
            } else {
                setError('Что то пошло не так');
            }
        }

        return new View(
            '/admin/post',
            ['title' => $post['type'] == 'post' ? 'Редактировать статью' : 'Редактировать Страницу',
                'errors' => $validator->errors(),
                'request' => $post]
        );
    }

    public function unpublishAction(string $t, int $id)
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']->canDo('edit_articles')) {
            throw new AccessDeniedException('Доступ запрещен');
        }

        $post = Post::find($id);
        $post->published = false;
        $post->save();
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function publishAction(string $t, int $id)
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']->canDo('edit_articles')) {
            throw new AccessDeniedException('Доступ запрещен');
        }

        $post = Post::find($id);
        $post->published = true;
        $post->save();
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function softDeleteAction(string $t, int $id)
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']->canDo('edit_articles')) {
            throw new AccessDeniedException('Доступ запрещен');
        }

        $post = Post::find($id);
        $post->published = false;
        $post->save();
        $post->delete();
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function restoreAction(string $t, int $id)
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']->canDo('edit_articles')) {
            throw new AccessDeniedException('Доступ запрещен');
        }

        $post = Post::onlyTrashed()->find($id);
        $post->restore();
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function forceDeleteAction(string $t, int $id)
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']->canDo('delete_articles')) {
            throw new AccessDeniedException('Доступ запрещен');
        }

        $post = Post::withTrashed()->find($id);
        if (isset($post->img_src)) {
            if (file_exists(UPLOAD_DIR . DIRECTORY_SEPARATOR . $post->img_src)) {
                unlink(UPLOAD_DIR . DIRECTORY_SEPARATOR . $post->img_src);
            }
        }
        $post->forceDelete();
        redirect($_SERVER['HTTP_REFERER']);
    }
}
