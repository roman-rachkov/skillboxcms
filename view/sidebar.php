<?php if (!isset($_SESSION['user']) || !$_SESSION['user']->subscribed) : ?>
    <form action="/subscribe" method="post">
        <span>Подписаться на рассылку</span>
        <div class="input-field">
            <?php if (!isset($_SESSION['user'])): ?>
                <input type="email" name="email" required placeholder="durov@tg.ru">
            <?php endif; ?>
        </div>
        <input type="submit" class="btn" value="Подписаться">
    </form>
<?php endif; ?>


