<ul class="tabs tabs-transparent menu menu-admin">
    <li class="tab">
        <a data-target="#drop-down-articles" onclick=""
           class="dropdown-trigger <?= \App\Router::checkPath('/admin') ? 'active' : '' ?>">
            Статьи
            <i class="material-icons right">arrow_drop_down</i>
        </a>
    </li>
    <li class="tab"><a class="<?= \App\Router::checkPath('/admin/comments') ? 'active' : '' ?>" href="/admin/comments">Комментарии<span
                class="badge white-text teal"><?= \App\Model\Comment::where('moderated', false)->count(); ?></span></a>
    </li>
    <?php if ($_SESSION['user']->canDo('edit_user')): ?>
    <li class="tab">
        <a data-target="#drop-down-users" onclick=""
           class="dropdown-trigger <?= \App\Router::checkPath('/admin/users') ? 'active' : '' ?>">
            Пользователи
            <i class="material-icons right">arrow_drop_down</i>
        </a>
    </li>
    <?php endif; ?>
    <?php if ($_SESSION['user']->canDo('edit_page')): ?>
    <li class="tab">
        <a data-target="#drop-down-pages" onclick=""
           class="dropdown-trigger <?= \App\Router::checkPath('/admin/page') ? 'active' : '' ?>">
            Страницы
            <i class="material-icons right">arrow_drop_down</i>
        </a>
    </li>
    <?php endif; ?>
    <?php if ($_SESSION['user']->canDo('edit_settings')): ?>
        <li class="tab">
            <a class="<?= \App\Router::checkPath('/admin/settings') ? 'active' : '' ?>"
               href="/admin/settings">Настройки</a>
        </li>
    <?php endif; ?>
</ul>

<ul id="drop-down-articles" class="drop-down z-depth-3">
    <li><a href="/admin/post?type=all" class="red-text text-darken-1">Все</a></li>
    <li><a href="/admin/post?type=published" class="red-text text-darken-1">Опубликованные</a></li>
    <li><a href="/admin/post?type=unpublished" class="red-text text-darken-1">Неопубликованные</a></li>
    <li class="divider"></li>
    <li><a href="/admin/post?type=trashed" class="red-text text-darken-1">На удаление</a></li>
</ul>

<ul id="drop-down-users" class="drop-down z-depth-3">
    <li><a href="/admin/users?type=all" class="red-text text-darken-1">Все</a></li>
    <li><a href="/admin/users?type=subscribed" class="red-text text-darken-1">Подписанные</a></li>
    <li><a href="/admin/users?type=unsubscribed" class="red-text text-darken-1">Не подписанные</a></li>
    <li class="divider"></li>
    <?php foreach (\App\Model\Role::all() as $role): ?>
        <a href="/admin/users?role=<?= $role->key ?>"><?= $role->name ?></a>
    <?php endforeach; ?>
    <li class="divider"></li>
    <li><a href="/admin/permissions" class="red-text text-darken-1">Права</a></li>
</ul>

<ul id="drop-down-pages" class="drop-down z-depth-3">
    <li><a href="/admin/page?type=all" class="red-text text-darken-1">Все</a></li>
    <li><a href="/admin/page?type=published" class="red-text text-darken-1">Опубликованные</a></li>
    <li><a href="/admin/page?type=unpublished" class="red-text text-darken-1">Неопубликованные</a></li>
    <li class="divider"></li>
    <li><a href="/admin/page?type=trashed" class="red-text text-darken-1">На удаление</a></li>
</ul>