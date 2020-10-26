<?php includeView('layouts/base/header', compact('title')); ?>
<body class="<?= $pageClass ?? 'index' ?>-page">
<header>
    <div class="container">
        <nav class="nav-extended">
            <div class="nav-wrapper">
                <a class="brand-logo" href="/">SkillBoxCMS</a>
                <a class="sidenav-trigger" href="#" data-target="mobile">
                    <i class="material-icons">menu</i>
                </a>
                <div class="hide-on-med-and-down" id="top-menu">
                    <?php includeView('layouts/menu'); ?>
                    <?php includeView('layouts/user-login'); ?>

                </div>
            </div>
            <div class="nav-content">
                <?php includeView('layouts/admin-menu');?>
            </div>
        </nav>
    </div>
</header>
<div class="sidenav" id="mobile">
    <?php includeView('layouts/user-login'); ?>
    <?php includeView('layouts/menu'); ?>
    <?php includeView('layouts/admin-menu'); ?>
</div>
<div class="content-wrapper">
    <div class="container">