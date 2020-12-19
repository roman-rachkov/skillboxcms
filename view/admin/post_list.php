<?php includeView("layouts/header", compact('title', 'pageClass')); ?>
    <div class="row">
        <aside class="col l2 m4 hide-on-small-and-down">
            <div class="row">
                <a href="/admin/<?=$type?>/new" class="btn waves-effect waves-light col s10 offset-s1"><?=$type == 'post' ? 'Новый пост':'Новая страница'?></a>
            </div>
            <?php includeView('layouts/per_page_select', ['paginator' => $articles]); ?>
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
                        <?php if ($article->published): ?>
                            <a href="/admin/<?=$article->type == 'post' ?'' : 'static/'?>unpublish/<?= $article->id ?>" data-position="top"
                               data-tooltip="Снять с публикации" class="tooltipped"><i
                                    class="material-icons small red-text text-darken-1">remove_circle</i></a>
                        <?php else: ?>
                            <a href="/admin/<?=$article->type == 'post' ?'' : 'static/'?>publish/<?= $article->id ?>" data-position="top"
                               data-tooltip="Опубликовать" class="tooltipped"><i
                                    class="material-icons small">publish</i></a>
                        <?php endif; ?>
                        <a href="/admin/<?=$article->type == 'post' ?'' : 'static/'?>edit/<?= $article->id ?>" class="tooltipped" data-position="top"
                           data-tooltip="Редактировать"><i class="material-icons small">edit</i></a>
                        <?php if ($article->deleted_at == null): ?>
                            <a href="/admin/<?=$article->type == 'post' ? '': 'static/'?>soft-delete/<?= $article->id ?>" class="tooltipped" data-position="top"
                               data-tooltip="Поместить в корзину"><i
                                    class="material-icons small red-text text-darken-1">delete</i></a>
                        <?php else: ?>
                            <a href="/admin/<?=$article->type == 'post' ?'' : 'static/'?>restore/<?= $article->id ?>" class="tooltipped" data-position="top"
                               data-tooltip="Востановить"><i
                                    class="material-icons small">restore</i></a>
                        <?php endif; ?>
                        <a href="/admin/<?=$article->type == 'post' ?'': 'static/'?>force-delete/<?= $article->id ?>" class="tooltipped delete-post" data-position="top" data-tooltip="Удалить навсегда"><i
                                class="material-icons small red-text text-darken-1">delete_forever</i></a>
                    </td>
                </tr>

            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php includeView('layouts/pagination', ['paginator' => $articles]); ?>

<?php includeView('layouts/footer', []); ?>



