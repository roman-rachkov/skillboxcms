<?php includeView('layouts/header', ['title' => $article->title]); ?>

<h1><?= $article->title ?></h1>
<hr>
<div class="row">
    <img src="/<?= UPLOAD_DIR_NAME . $article->img_src ?>" alt="<?= $article->title ?>" class="image-responsive col s12">
</div>
<p>
    <?= $article->text ?>
</p>
<?php includeView('layouts/footer'); ?>
