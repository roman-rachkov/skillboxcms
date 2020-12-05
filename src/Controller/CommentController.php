<?php


namespace App\Controller;

use App\Exception\AccessDeniedException;
use App\Exception\NotFoundException;
use App\Model\Comment;
use App\Model\Post;
use App\Request;

class CommentController extends BaseController
{
    public function addAction(int $postId)
    {
        if ($postId == null) {
            throw new AccessDeniedException('Неверные данные отправки комментария');
        }

        $post = Post::find($postId);
        if ($post === null) {
            throw new NotFoundException('Статья не найдена или удалена');
        }

        $data = Request::post();

        if (empty($data['comment'])) {
            throw new AccessDeniedException('Неверные данные отправки комментария');
        }

        $comment = new Comment();
        $comment->text = $data['comment'];
        $comment->parent_id = $data['parent_id'] ?? null;
        $comment->user_id = $_SESSION['user']->id;
        $comment->moderated = $_SESSION['user']->hasRole(['administrator', 'moderator']);

        if ($post->comments()->save($comment)) {
            Comment::fixTree();
            setSuccess('Комментарий успешно добавлен');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function editAction(int $id)
    {
        if ($id == null) {
            throw new AccessDeniedException('Неверные данные отправки комментария');
        }

        $data = Request::post();

        if (empty($data['comment'])) {
            throw new AccessDeniedException('Неверные данные отправки комментария');
        }

        $comment = Comment::find($id);

        if ($comment == null) {
            throw new NotFoundException('Комментарий не найден или удален');
        }

        if ($comment->user->id != $_SESSION['user']->id && !$_SESSION['user']->canDo('edit_comment')) {
            throw new AccessDeniedException('Нет прав на редактирование');
        }

        $comment->text = $data['comment'];
        $comment->moderated = $_SESSION['user']->hasRole(['administrator', 'moderator']);

        if ($comment->save()) {
            setSuccess('Комментарий успешно обновлен');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}
