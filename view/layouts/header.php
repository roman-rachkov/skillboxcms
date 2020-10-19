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
                    </ul>
                    <div class="user"><p>Привет, Гость!</p>
                        <p><a class="light-blue-text text-accent-4" href="#">Войти</a> или<a
                                class="light-blue-text text-accent-4" href="/registration"> Зарегистрироваться</a>!
                        </p></div>
                </div>
            </div>
        </nav>
    </div>
</header>
<div class="sidenav" id="mobile">
    <div class="user"><p>Привет, Гость!</p>
        <p><a class="light-blue-text text-accent-4" href="#">Войти</a> или<a class="light-blue-text text-accent-4"
                                                                             href="/registration">
                Зарегистрироваться</a>!</p></div>
    <ul class="menu">
        <li class="menu__item menu__item_active"><a href="/">Главная</a></li>
        <li class="menu__item"><a href="/">Страница 1</a></li>
        <li class="menu__item"><a href="/">Страница 2</a></li>
        <li class="menu__item"><a href="/">Страница 3</a></li>
        <li class="menu__item"><a href="/">Страница 4</a></li>
    </ul>
</div>
<div class="content-wrapper">