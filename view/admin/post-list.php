<?php includeView("layouts/admin_header", compact('title','pageClass')); ?>
    <h1>Список постов</h1>
    <div class="row">
        <aside class="col l2 m4 hide-on-small-and-down">
            <div class="row">
                <a href="/admin/new" class="btn waves-effect waves-light col s10 offset-s1">Новый пост</a>
            </div>
        </aside>
        <table class="striped col l10 m8 s12">
            <thead>
            <tr>
                <th>Название</th>
                <th>Автор</th>
                <th>Дата публикации</th>
                <th>Управление</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>Alvin</td>
                <td>Eclair</td>
                <td>$0.87</td>
                <td>$0.87</td>
            </tr>
            </tbody>
        </table>
    </div>
<?php includeView('layouts/admin_footer', []);?>