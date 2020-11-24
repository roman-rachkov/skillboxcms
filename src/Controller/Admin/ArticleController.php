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
        if (!isset($_SESSION['user']) || !$_SESSION['user']->canDo('view_admin')) {
            throw new AccessDeniedException('Доступ запрещен!');
        }

        $paginate = Request::get('perpage');
        $paginate = is_array($paginate) ? Settings::getInstance()->get('result_per_page',
            Config::getInstance()->get('default.result_per_page')) : $paginate;

        return new View('admin/post-list',
            [
                'title' => "Список постов",
                'pageClass' => 'admin',
                'articles' => Post::where('type', 'post')->paginate($paginate, ['*'], 'page', Request::get('page'))->setPath('/admin')
            ]);
    }

    public function editAction()
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']->canDo('create_articles')) {
            throw new AccessDeniedException('Доступ запрещен');
        }

        $post = Request::post();
        $article = Post::find($post['id']);
        if(!$article){
            throw new NotFoundException('Статья не найдена');
        }
        $validator = new ArticleValidator($post);

        if ($validator->validate()) {

            $article->title = $post['title'];
            $article->text = $post['text'];

            $image = tryToUploadFile('image', 'articles');
            if ($image) {
                if(file_exists(UPLOAD_DIR.DIRECTORY_SEPARATOR.$article->img_src)){
                    unlink(UPLOAD_DIR.DIRECTORY_SEPARATOR.$article->img_src);
                }
                $article->img_src = DIRECTORY_SEPARATOR.'articles'.DIRECTORY_SEPARATOR.$image['name'];
            }
            if ($_SESSION['user']->articles()->save($article)) {
                setSuccess('Статья успешно обновлена');
                redirect('/article/' . $article->id);
            } else {
                setError('Что то пошло не так');
            }
        }
        return new View('/admin/post', ['title' => 'Новая статья', 'errors' => $validator->errors(), 'request' => $post]);
    }

    public function addAction()
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']->canDo('edit_articles')) {
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
                $article->img_src = DIRECTORY_SEPARATOR.'articles'.DIRECTORY_SEPARATOR.$image['name'];
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

}