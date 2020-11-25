<?php

namespace App\Controller\Admin;

use App\Config;
use App\Exception\AccessDeniedException;
use App\Exception\NotFoundException;
use App\Model\Post;
use App\Request;
use App\Settings;
use App\Validators\ArticleValidator;
use App\View\View;

class ArticleController extends BaseController
{

    public function indexAction()
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']->canDo('edit_articles')) {
            throw new AccessDeniedException('Доступ запрещен!');
        }

        $type = Request::get('type');
        $type = is_array($type) ? 'all' : $type;

        if ($type == 'trashed') {
            $posts = Post::onlyTrashed()->where('type', 'post');
        } elseif ($type == 'unpublished') {
            $posts = Post::where('published', false)->where('type', 'post');
        } elseif ($type == 'published') {
            $posts = Post::where('published', true)->where('type', 'post');
        } else {
            $posts = Post::where('type', 'post');
        }

        $paginate = Request::get('perpage');
        $paginate = is_array($paginate) ? Settings::getInstance()->get('result_per_page',
            Config::getInstance()->get('default.result_per_page')) : $paginate;

        $page = Request::get('page');
        $page = is_array($page) ? 1 : $page;

        if ($paginate != 'all') {
            $posts = $posts->paginate($paginate, ['*'], 'page', $page)->setPath('/admin');
        } else {
            $posts = $posts->all();
        }
        return new View('admin/post_list',
            [
                'title' => "Список постов",
                'pageClass' => 'admin',
                'articles' => $posts
            ]);
    }

    public function addAction()
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']->canDo('create_articles')) {
            throw new AccessDeniedException('Доступ запрещен');
        }

        $post = Request::post();

        $validator = new ArticleValidator($post);

        if ($validator->validate()) {
            $article = new Post();
            $article->title = $post['title'];
            $article->text = $post['text'];
            $article->type = 'post';

            $image = tryToUploadFile('image', 'articles');
            if ($image) {
                $article->img_src = DIRECTORY_SEPARATOR . 'articles' . DIRECTORY_SEPARATOR . $image['name'];
            }
            if ($_SESSION['user']->articles()->save($article)) {
                setSuccess('Статья успешно создана');
                redirect('/article/' . $article->id);
            } else {
                setError('Что то пошло не так');
            }
        }
        return new View('/admin/post', ['title' => 'Новая статья', 'errors' => $validator->errors(), 'request' => $post]);
    }

    public function unpublishAction(int $id)
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']->canDo('edit_articles')) {
            throw new AccessDeniedException('Доступ запрещен');
        }

        $post = Post::find($id);
        $post->published = false;
        $post->save();
        redirect($_SERVER['HTTP_REFERER']);

    }

    public function publishAction(int $id)
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']->canDo('edit_articles')) {
            throw new AccessDeniedException('Доступ запрещен');
        }

        $post = Post::find($id);
        $post->published = true;
        $post->save();
        redirect($_SERVER['HTTP_REFERER']);

    }

    public function softDeleteAction(int $id)
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

    public function restoreAction(int $id)
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']->canDo('edit_articles')) {
            throw new AccessDeniedException('Доступ запрещен');
        }

        $post = Post::onlyTrashed()->find($id);
        $post->restore();
        redirect($_SERVER['HTTP_REFERER']);

    }

    public function forceDeleteAction(int $id)
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']->canDo('delete_articles')) {
            throw new AccessDeniedException('Доступ запрещен');
        }

        $post = Post::withTrashed()->find($id);
        if(isset($post->img_src)){
            if (file_exists(UPLOAD_DIR . DIRECTORY_SEPARATOR . $post->img_src)) {
                unlink(UPLOAD_DIR . DIRECTORY_SEPARATOR . $post->img_src);
            }
        }
        $post->forceDelete();
        redirect($_SERVER['HTTP_REFERER']);

    }
}