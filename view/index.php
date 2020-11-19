<?php
includeView('layouts/header', ['title' => 'Главная']);
?>
    <h1>Главная</h1>
    <hr>
    <div class="row">

        <?php foreach ($articles as $article):?>
            <div class="card sticky-action col s12 hoverable">
                <?php if ($article->img_src): ?>
                    <div class="card-image">
                        <img src="/<?= UPLOAD_DIR_NAME . $article->img_src ?>" class="image-responsive" style="max-height: 300px; object-fit: cover; object-position: top center">
                    </div>
                <?php endif; ?>
                <div class="card-content">
                    <span class="card-title black-text"><?= $article->title ?></span>

                    <p><?= shortString($article->text, 300) ?></p>
                </div>
                <div class="card-action">
                    <a href="/article/<?= $article->id ?>">Читать дальше</a>
                </div>

                <div class="card-reveal">...</div>
            </div>
        <?php endforeach; ?>
    </div>

<?php
includeView('layouts/footer');
?>