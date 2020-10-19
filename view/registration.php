<?php includeView('layouts/header', compact('title')); ?>
    <section>
        <div class="container">
            <div class="row">
                <form class="registration-form col s12" action="#" method="post">
                    <div class="input-field">
                        <label for="login">Логин</label>
                        <input class="validate" type="text"
                               name="username"
                               placeholder="Ваш логин"
                               autocomplete="username"
                               value="<?= $request['username'] ?? '' ?>"
                               id="login">
                        <?php isset($errors['username']) ? printInputErrors($errors['username']) : '' ?>
                    </div>
                    <div class="input-field">
                        <label for="Email">E-mail</label>
                        <input class="validate" type="email"
                               name="email"
                               placeholder="Ваш E-mail"
                               autocomplete="email"
                               value="<?= $request['email'] ?? '' ?>"
                               id="email">
                        <?php isset($errors['email']) ? printInputErrors($errors['email']) : '' ?>
                    </div>
                    <div class="input-field">
                        <label for="pass">Пароль</label>
                        <input class="validate" type="password"
                               name="password"
                               placeholder="Введите пароль"
                               autocomplete="new-password"
                               id="pass">
                        <?php isset($errors['password']) ? printInputErrors($errors['password']) : '' ?>
                    </div>
                    <div class="input-field">
                        <label for="pass_confirm">Подтвердите пароль</label>
                        <input class="validate"
                               type="password"
                               name="confirm_password"
                               placeholder="Подтвердите пароль"
                               autocomplete="new-password"
                               id="pass_confirm">
                        <?php isset($errors['confirm_password']) ? printInputErrors($errors['confirm_password']) : '' ?>
                    </div>
                    <div class="row">
                        <div class="input-field">
                            <label>
                                <input type="checkbox" name="accept_rules"
                                       class="validate" <?= (isset($request['accept_rules']) && $request['accept_rules']) ? 'checked' : '' ?>>
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
        </div>
    </section>
<?php includeView('layouts/footer'); ?>