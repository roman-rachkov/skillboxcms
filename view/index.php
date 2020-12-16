<?php
includeView('layouts/header', ['title' => 'Список статей']);
?>
    <div class="row">
        <?php if (!isset($_SESSION['user']) || !$_SESSION['user']->subscribed): ?>

        <div class="col s12 m10">
        <?php else: ?>
        <div class="col s12">

        <?php endif; ?>
            <div class="row">

                <?php foreach ($articles as $article): ?>
                    <div class="card sticky-action col s12 hoverable">
                        <?php if ($article->img_src && file_exists(UPLOAD_DIR.$article->img_src)): ?>
                            <div class="card-image">
                                <img src="/<?= UPLOAD_DIR_NAME . $article->img_src ?>" class="image-responsive"
                                     style="max-height: 300px; object-fit: cover; object-position: top center">
                            </div>
                        <?php endif; ?>
                        <div class="card-content">
                            <span class="card-title black-text"><?= $article->title ?></span>

                            <p><?= shortString($article->text, 300) ?></p>
                            <span class="help-text">Опубликованно: <?=$article->created_at;?></span>
                        </div>
                        <div class="card-action">
                            <a href="/article/<?= $article->id ?>">Читать дальше</a>
                        </div>

                        <div class="card-reveal">...</div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php includeView('layouts/pagination', ['paginator' => $articles]); ?>
            </div>
        <?php if (!isset($_SESSION['user']) || !$_SESSION['user']->subscribed): ?>
        <div class="col s12 m2 sidebar">
            <?php includeView('sidebar'); ?>
        </div>
        <?php endif; ?>
    </div>

<?php
includeView('layouts/footer');
?>