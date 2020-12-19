<?php


namespace App\Controller;

use App\Config;
use App\Exception\NotFoundException;
use App\Model\Post;
use App\Request;
use App\Settings;
use App\View\View;

class ArticleController extends BaseController
{
    public function indexAction()
    {
        $paginate = Settings::getInstance()->get(
            'result_per_page',
            Config::getInstance()->get('default.result_per_page')
        );

        $page = Request::get('page');
        $page = is_array($page) ? 1 : $page;

        if ($paginate != 'all') {
            $articles = Post::where('type', 'post')->where('published', true)->orderByDesc('created_at')->paginate($paginate, ['*'], 'page', $page);
        } else {
            $articles = Post::here('type', 'post')->where('published', true)->orderByDesc('created_at')->get();
        }

        return new View('index', compact('articles'));
    }

    public function singleAction(int $id)
    {
        $article = Post::find($id);
        if (!$article) {
            throw new NotFoundException('Страница не найдена');
        }
        $errors = null;
        return new View('post', compact('article', 'errors'));
    }

}
