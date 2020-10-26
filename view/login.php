<?php includeView('layouts/header', compact('title')); ?>
            <h1>Вход</h1>
            <div class="row">
                <form class="login-form col s12" action="#" method="post">
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
                    <div class="input-field right">
                        <button class="btn waves-effect waves-light" type="submit">Зарегистрироваться</button>
                    </div>
                </form>
            </div>
<?php includeView('layouts/footer'); ?>