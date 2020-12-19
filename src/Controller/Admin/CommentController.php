<?php

namespace App\Controller\Admin;

use App\Config;
use App\Exception\AccessDeniedException;
use App\Exception\NotFoundException;
use App\Model\Comment;
use App\Request;
use App\View\View;

class CommentController extends BaseController
{

    public function indexAction(){
        if (!$_SESSION['user']->canDo('moderate_comments')) {
            throw new AccessDeniedException('Доступ запрещен!');
        }

        $paginate = Request::get('perpage');
        $paginate = is_array($paginate) ? \App\Settings::getInstance()->get(
            'result_per_page',
            Config::getInstance()->get('default.result_per_page')
        ) : $paginate;

        $page = Request::get('page');
        $page = is_array($page) ? 1 : $page;

        if ($paginate != 'all') {
            $comments = Comment::where('moderated', false)->paginate($paginate, ['*'], 'page', $page);
        } else {
            $comments = Comment::all();
        }

        return new View('admin\comments_list', ['comments' => $comments, 'title' => "Новые комментарии"]);
    }

    public function unmoderateAction(int $id){
        if (!$_SESSION['user']->canDo('moderate_comments')){
            throw new AccessDeniedException('Доступ запрещен!');
        }

        $comment = Comment::find($id);

        if ($comment == null) {
            throw new NotFoundException('Комментарий не найден или удален');
        }

        $comment->moderated = false;
        if ($comment->save()) {
            setSuccess('Комментарий отправлен на модерацию');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            setError('Произошла ошибка, пожалуйста обновите страницу и попробуйте снова');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function moderateAction(int $id){
        if (!$_SESSION['user']->canDo('moderate_comments')) {
            throw new AccessDeniedException('Доступ запрещен!');
        }

        $comment = Comment::find($id);

        if ($comment == null) {
            throw new NotFoundException('Комментарий не найден или удален');
        }

        $comment->moderated = true;
        if ($comment->save()) {
            setSuccess('Комментарий одобрен');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            setError('Произошла ошибка, пожалуйста обновите страницу и попробуйте снова');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}