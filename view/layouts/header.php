<?php includeView('layouts/base/header', compact('title')); ?>
<body class="<?= $pageClass ?? 'index' ?>-page">
<header>
    <div class="container">
        <nav>
            <div class="nav-wrapper"><a class="brand-logo" href="/">SkillBoxCMS</a><a class="sidenav-trigger" href="#"
                                                                                      data-target="mobile"><i
                        class="material-icons">menu</i></a>
                <div class="hide-on-med-and-down" id="top-menu">
                    <ul class="menu">
                        <li class="menu__item menu__item_active"><a href="/">Главная</a></li>
                        <li class="menu__item"><a href="/">Страница 1</a></li>
                        <li class="menu__item"><a href="/">Страница 2</a></li>
                        <li class="menu__item"><a href="/">Страница 3</a></li>
                        <li class="menu__item"><a href="/">Страница 4</a></li>
                        <?= isset($_SESSION['user']) && $_SESSION['user']->canDo('view_admin') ? '<li class="menu__item"><a href="/admin">Админка</a></li>
' : ''?>
                    </ul>
                    <?php includeView('layouts/user-login');?>
                </div>
            </div>
        </nav>
    </div>
</header>
<div class="sidenav" id="mobile">
    <?php includeView('layouts/user-login');?>
    <ul class="menu">
        <li class="menu__item menu__item_active"><a href="/">Главная</a></li>
        <li class="menu__item"><a href="/">Страница 1</a></li>
        <li class="menu__item"><a href="/">Страница 2</a></li>
        <li class="menu__item"><a href="/">Страница 3</a></li>
        <li class="menu__item"><a href="/">Страница 4</a></li>
    </ul>
</div>
<div class="content-wrapper">