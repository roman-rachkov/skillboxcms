<?php includeView('layouts/header', ['title' => $title]); ?>

    <div class="row">
        <?php if ($comments->hasPages()): ?>
            <div class="col s12 m3">
                <?php includeView('layouts/per_page_select', ['paginator' => $comments]); ?>
            </div>
            <div class="col s12 m9">
        <?php else: ?>
            <div class="col s12">
        <?php endif; ?>

            <?php foreach ($comments as $comment): ?>
                <div class="row">
                    <div class="col s12 comments">
                        <div class="card horizontal z-depth-0 comment" data-id="<?= $comment->id ?>">
                            <div class="card-image">
                                <a href="/profile/<?= $comment->user->id ?>">
                                    <?php if ($comment->user->avatar && file_exists(UPLOAD_DIR . $comment->user->avatar)): ?>
                                        <img src="/<?= UPLOAD_DIR_NAME . $comment->user->avatar ?>"
                                             alt="<?= $comment->user->username ?>" class="avatar">
                                    <?php else: ?>
                                        <img src="/static/img/empty-avatar.jpg" class="avatar"
                                             alt="<?= $comment->user->username ?>">
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="card-stacked">
                                <div class="card-content">
                                    <a href="/profile/<?= $comment->user->id ?>">
                                        <span class="card-title"><?= $comment->user->username ?></span>
                                    </a>
                                    <p><?= $comment->text; ?></p>
                                    <?php if (!$comment->moderated): ?>
                                        <span class="help-text">Комментарий не был модерирован</span>
                                    <?php endif; ?>
                                </div>
                                <div class="card-action teal lighten-5">
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
                </div>
            <?php endforeach; ?>

            <?php includeView('layouts/pagination', ['paginator' => $comments]); ?>
        </div>
    </div>

<?php includeView('layouts/footer'); ?>