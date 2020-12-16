<?php includeView('layouts/header', ['title' => $article->title]); ?>
<hr>
<?php if ($article->img_src && file_exists(UPLOAD_DIR . $article->img_src)): ?>
    <div class="row">
        <img src="/<?= UPLOAD_DIR_NAME . $article->img_src ?>" alt="<?= $article->title ?>"
             class="image-responsive col s12">
    </div>
<?php endif; ?>
<p>
    <?= $article->text ?>
</p>
<span class="help-text">Опубликованно: <?= $article->created_at ?></span>

<hr class="divider">

<?php if ($type == 'post'): ?>
    <div class="comments">
        <?php includeView('layouts/comments/comments_list', ['article' => $article]); ?>

        <?php includeView('layouts/comments/comment_form', ['article' => $article]); ?>
    </div>
<?php endif; ?>

<?php includeView('layouts/footer'); ?>
