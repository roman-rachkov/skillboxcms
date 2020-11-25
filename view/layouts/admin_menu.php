<ul class="tabs tabs-transparent menu menu-admin">
    <li class="tab">
        <a data-target="#drop-down-articles" onclick=""
           class="dropdown-trigger <?= \App\Router::checkPath('/admin') ? 'active' : '' ?>">
            Статьи
            <i class="material-icons right">arrow_drop_down</i>
        </a>
    </li>
    <li class="tab"><a class="" href="#test2">Test 2</a></li>
    <li class="tab "><a href="#test3">Disabled Tab</a></li>
    <li class="tab"><a href="#test4">Test 4</a></li>
</ul>

<ul id="drop-down-articles" class="drop-down z-depth-3">
    <li><a href="/admin?type=all" class="red-text text-darken-1">Все</a></li>
    <li><a href="/admin?type=published" class="red-text text-darken-1">Опубликованные</a></li>
    <li><a href="/admin?type=unpublished" class="red-text text-darken-1">Неопубликованные</a></li>
    <li class="divider"></li>
    <li><a href="/admin?type=trashed" class="red-text text-darken-1">На удаление</a></li>
</ul>