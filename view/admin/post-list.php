<?php includeView("layouts/header", compact('title', 'pageClass')); ?>
    <h1 class="center-align">Список постов</h1>
    <div class="row">
        <aside class="col l2 m4 hide-on-small-and-down">
            <div class="row">
                <a href="/admin/new" class="btn waves-effect waves-light col s10 offset-s1">Новый пост</a>
            </div>
            <?php if ($articles->hasPages()): ?>
                <div class="row">
                    <div class="input-field col s10 offset-s1" >
                        <select name="perpage">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="200">200</option>
                            <option value="0">Все</option>
                        </select>
                        <label>Записей на странице</label>
                    </div>
                </div>
            <?php endif; ?>
        </aside>
        <table class="highlight centered col l10 m8 s12">
            <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Автор</th>
                <th>Дата публикации</th>
                <th>Управление</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($articles as $article): ?>
                <tr>
                    <td><?= $article->id ?></td>
                    <td><?= $article->title ?></td>
                    <td><?= $article->user->username ?></td>
                    <td><?= $article->created_at ?></td>
                    <td>
                        <? if ($article->published): ?>
                            <a href="#" data-position="top" data-tooltip="Снять с публикации" class="tooltipped"><i
                                    class="material-icons small red-text text-darken-1">remove_circle</i></a>
                        <? else: ?>
                            <a href="#" data-position="top" data-tooltip="Опубликовать" class="tooltipped"><i
                                    class="material-icons small">publish</i></a>
                        <? endif; ?>
                        <a href="/admin/edit/<?= $article->id ?>" class="tooltipped" data-position="top"
                           data-tooltip="Редактировать"><i class="material-icons small">edit</i></a>
                        <a href="#" class="tooltipped" data-position="top" data-tooltip="Поместить в корзину"><i
                                class="material-icons small red-text text-darken-1">delete</i></a>
                        <a href="#" class="tooltipped" data-position="top" data-tooltip="Удалить навсегда"><i
                                class="material-icons small red-text text-darken-1">delete_forever</i></a>
                    </td>
                </tr>

            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php printPagination($articles); ?>

<?php includeView('layouts/admin_footer', []); ?>