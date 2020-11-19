<?php includeView('/layouts/admin_header', ['title' => $title, 'pageClass' => $pageClass]); ?>
    <H1 class="center-align"><?= $title ?></H1>
    <div class="row">
        <form class="col s12" <?= isset($article) ? 'action="/admin/edit"' : 'action="/admin/new"' ?> method="post"
              enctype="multipart/form-data">
            <div class="row">
                <div class="input-field col s12">
                    <?= isset($article) ? '<input name="id" type="hidden" value="' . $article->id . '">' : '' ?>
                    <input type="text" name="title" placeholder="Золотая статья о дожде" class="validate"
                           id="article-title" required <?= isset($article) ? 'value="' . $article->title . '"' : '' ?>>
                    <label for="article-title">Заголовок статьи</label>
                </div>

            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea id="textarea1" class="materialize-textarea validate"
                              placeholder="Большой и интересный текст о дожде" name="text"
                              required><?= isset($article) ? $article->text : '' ?></textarea>
                    <label for="textarea1">Статья</label>
                </div>
            </div>
            <?php if (isset($article) && $article->img_src): ?>
                <div class="row">
                    <img src="/<?= UPLOAD_DIR_NAME . $article->img_src ?>" alt="" class="col s12">
                </div>
            <? endif; ?>
            <div class="row">
                <div class="col s12 file-field input-field">
                    <div class="btn">
                        <span>File</span>
                        <input type="file" name="image">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
            </div>
            <div class="row">
                <button class="btn waves-effect waves-light" type="submit">
                    <?php if (isset($article)): ?>
                        <i class="material-icons left">restore_page</i>
                        Обновить
                    <?php else: ?>
                        <i class="material-icons left">note_add</i>
                        Опубликовать
                    <? endif; ?>
                </button>
                <a class="btn waves-effect waves-light white black-text" href="#" onclick="history.back()">
                    <i class="material-icons left">cancel</i>
                    Отмена
                </a>
            </div>
        </form>

    </div>


<?php includeView('/layouts/admin_footer'); ?>