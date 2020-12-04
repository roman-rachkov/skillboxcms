<?php foreach ($comments as $comment): ?>
    <?php if ($comment->moderated || $_SESSION['user']->canDo('moderate_comments') || $comment->user->id == $_SESSION['user']->id): ?>
        <div class="col s<?= 12 - $level < 6 ? 6 : 12 - $level ?> offset-s<?= $level > 6 ? 6 : $level; ?>">
            <div class="card horizontal z-depth-0 comment <?= $level != 0 ?: 'root'; ?>" data-id="<?= $comment->id ?>">
                <div class="card-image">
                    <img src="https://lorempixel.com/100/190/nature/6">
                </div>
                <div class="card-stacked">
                    <div class="card-content">
                        <span class="card-title"><?= $comment->user->username ?></span>
                        <p><?= $comment->text; ?></p>
                        <?php if (!$comment->moderated): ?>
                            <span class="help-text">Комментарий не был модерирован</span>
                        <?php endif; ?>
                    </div>
                    <div class="card-action teal lighten-5">
                        <?php if ($comment->moderated || $_SESSION['user']->canDo('moderate_comments')): ?>
                            <a href="#" class="answer-link tooltipped" data-tooltip="Ответить"><i
                                    class="material-icons tiny">question_answer</i></a>
                        <?php endif; ?>
                        <?php if ($comment->user->id == $_SESSION['user']->id || $_SESSION['user']->canDo('edit_comment')): ?>
                            <a href="#" class="edit-link tooltipped" data-tooltip="Редактировать"><i
                                    class="material-icons tiny blue-text text-darken-1">edit</i></a>
                        <?php endif; ?>
                        <?php if ($comment->user->id == $_SESSION['user']->id || $_SESSION['user']->canDo('delete_comment')): ?>
                            <a href="#" class="edit-link tooltipped" data-tooltip="Удалить"><i
                                    class="material-icons tiny red-text text-darken-1">delete</i></a>
                        <?php endif; ?>
                        <?php if ($_SESSION['user']->canDo('moderate_comments')): ?>
                            <div class="admin-links right tooltipped">
                                <?php if (!$comment->moderated): ?>
                                    <a href="/admin/comments/moderate/<?=$comment->id?>" class="tooltipped" data-tooltip="Подтвердить модерацию"><i
                                            class="material-icons tiny green-text text-darken-1">check</i></a>
                                <?php else: ?>
                                    <a href="/admin/comments/unmoderate/<?=$comment->id?>" class="tooltipped" data-tooltip="Отпраить на модерацию"><i
                                            class="material-icons tiny red-text text-darken-1">clear</i></a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php includeView('layouts/comments/comments', ['comments' => $comment->children, 'level' => $level + 1]); ?>
    <?php endif; ?>
<?php endforeach; ?>