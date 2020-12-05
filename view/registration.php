<?php includeView('layouts/header', compact('title')); ?>
    <h1>Регистрация</h1>
    <div class="row">
        <form class="registration-form col s12" action="#" method="post">
            <div class="input-field">
                <label for="login">Имя</label>
                <input class="validate <?= isset($errors['username']) ? 'invalid' : '' ?>" type="text"
                       name="username"
                       placeholder="Ваше имя"
                       autocomplete="username"
                       value="<?= $request['username'] ?? '' ?>"
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
                       value="<?= $request['email'] ?? '' ?>"
                       id="email"
                       required>
                <?php isset($errors['email']) ? printInputErrors($errors['email']) : '' ?>
            </div>
            <div class="input-field">
                <label for="pass">Пароль</label>
                <input class="validate <?= isset($errors['password']) ? 'invalid' : '' ?>" type="password"
                       name="password"
                       placeholder="Введите пароль"
                       autocomplete="new-password"
                       id="pass"
                       required>
                <?php isset($errors['password']) ? printInputErrors($errors['password']) : '' ?>
            </div>
            <div class="input-field">
                <label for="pass_confirm">Подтвердите пароль</label>
                <input class="validate <?= isset($errors['confirm_password']) ? 'invalid' : '' ?>"
                       type="password"
                       name="confirm_password"
                       placeholder="Подтвердите пароль"
                       autocomplete="new-password"
                       id="pass_confirm"
                       required>
                <?php isset($errors['confirm_password']) ? printInputErrors($errors['confirm_password']) : '' ?>
            </div>
            <div class="row">
                <div class="input-field">
                    <label>
                        <input type="checkbox" name="accept_rules"
                               class="validate <?= isset($errors['accept_rules']) ? 'invalid' : '' ?>" <?= (isset($request['accept_rules']) && $request['accept_rules']) ? 'checked' : '' ?>
                               required>
                        <span>Согласен с <a href="#" target="_blank">правилами</a> сайта</span>
                    </label>
                    <?php isset($errors['accept_rules']) ? printInputErrors($errors['accept_rules']) : '' ?>
                </div>
                <div class="input-field right">
                    <button class="btn waves-effect waves-light" type="submit">Зарегистрироваться</button>
                </div>
            </div>
        </form>
    </div>
<?php includeView('layouts/footer'); ?>