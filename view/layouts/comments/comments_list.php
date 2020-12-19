<?php if ( isset($_SESSION['user']) && (
        ($_SESSION['user']->canDo('moderate_comment') && !$article->comments->isNotEmpty()) ||
        (!$_SESSION['user']->canDo('moderate_comment') && !$article->comments()->where('moderated', true)->get()->isNotEmpty()))): ?>
    <span class="add-info">Комментариев еще не было.</span>
<?php else: ?>
    <div class="row">
        <?php includeView('layouts/comments/comments', ['comments' => $article->comments->toTree(), 'level' => 0]); ?>
    </div>
<?php endif; ?>