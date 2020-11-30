<?php


namespace App\Controller;


use App\Exception\AccessDeniedException;
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
            throw new AccessDeniedException('Неверные данные отправки комментария');
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

}