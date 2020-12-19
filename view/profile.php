<?php includeView('layouts\header', ['title' => 'Профиль пользователя ' . $user->username, 'pageClass' => 'profile']); ?>

<?= (isset($_SESSION['user']) && ($_SESSION['user']->id == $user->id || $_SESSION['user']->canDo('edit_user'))) ?
                        '<form method="post" action="/profile/'.$user->id.'" enctype="multipart/form-data">' : '' ?>
    <div class="row">
        <div class="col s12 m4">
            <div class="wrp">
                <?php if ($user->avatar && file_exists(UPLOAD_DIR . $user->avatar)): ?>
                    <img src="/<?= UPLOAD_DIR_NAME . $user->avatar ?>" alt="<?= $user->username ?>" class="avatar">
                <?php else: ?>
                    <img src="/static/img/empty-avatar.jpg" class="avatar" alt="<?= $user->username ?>">
                <?php endif; ?>
            </div>

            <?php if (isset($_SESSION['user']) && ($_SESSION['user']->id == $user->id || $_SESSION['user']->canDo('edit_user'))): ?>
                <div class="file-field input-field">
                    <div class="btn">
                        <span>File</span>
                        <input type="file" name="avatar" accept="image/png, image/jpeg">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="col s12 m8">
            <?php if (isset($_SESSION['user']) && ($_SESSION['user']->id == $user->id || $_SESSION['user']->canDo('edit_user'))): ?>
                <div class="input-field">
                    <label for="login">Имя</label>
                    <input class="validate <?= isset($errors['username']) ? 'invalid' : '' ?>" type="text"
                           name="username"
                           placeholder="Ваше имя"
                           autocomplete="username"
                           value="<?= $user->username ?>"
                           id="login"
                           required>
                    <?php isset($errors['username']) ? printInputErrors($errors['username']) : '' ?>
                </div>
                <div class="input-field">
                    <label for="Email">E-mail</label>
                    <input class="validate <?= isset($errors['email']) ? 'invalid' : '' ?>" type="email"
                           name="email"
                           placeholder="Ваш E-mail"
                           autocomplete="email"
                           value="<?= $user->email ?>"
                           id="email"
                           required>
                    <?php isset($errors['email']) ? printInputErrors($errors['email']) : '' ?>
                </div>
                <div class="input-field">
                    <textarea class="materialize-textarea" name="about"><?= $user->about ?></textarea>
                    <label for="textarea1">О себе</label>
                    <?php isset($errors['about']) ? printInputErrors($errors['about']) : '' ?>
                </div>
                <?php if ($user->subscribed): ?>
                    <a href="/unsubscribe" class="btn red">Отписаться</a>
                <?php else: ?>
                    <a href="/subscribe" class="btn subscribe">Подписаться</a>
                <?php endif; ?>
                <?= isset($_SESSION['user']) && ($_SESSION['user']->id == $user->id || $_SESSION['user']->canDo('edit_user')) ? '<button type="submit" class="btn waves-effect waves-light"><i class="material-icons left">sync</i>Обновить</button>' : '' ?>
            <?php else: ?>

            <h4><?=$user->username?></h4>
            <p><?=$user->email?></p>
            <p><?=$user->about?></p>

            <?php endif; ?>
            <p>Всего комментариев: <?=$user->comments->where('moderated', true)->count()?></p>

        </div>

    </div>
<?= isset($_SESSION['user']) && ($_SESSION['user']->id == $user->id || $_SESSION['user']->canDo('edit_user')) ? '</form>' : '' ?>


<?php includeView('layouts\footer'); ?>