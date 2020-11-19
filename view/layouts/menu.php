<ul class="menu">
    <li class="menu__item <?= \App\Router::checkPath('/') ? ' menu__item_active' : '' ?>"><a href="/">Главная</a>
    </li>
    <li class="menu__item"><a href="/">Страница 1</a></li>
    <li class="menu__item"><a href="/">Страница 2</a></li>
    <li class="menu__item"><a href="/">Страница 3</a></li>
    <li class="menu__item"><a href="/">Страница 4</a></li>
    <?php if (isset($_SESSION['user']) && $_SESSION['user']->canDo('view_admin')) :
        $activeAdmin = mb_stripos(\App\Router::getPath(), '/admin') !== false ? 'menu__item_active' : '';
        ?>
        <li class="menu__item <?= $activeAdmin ?>">
            <a href="/admin">Админка</a>
        </li>
    <?php endif; ?>
</ul>