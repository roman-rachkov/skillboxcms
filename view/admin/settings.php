<?php includeView('layouts\header', compact('title')); ?>

    <form action="/admin/settings" method="post">
        <div class="row">
            <?php foreach (\App\Settings::getInstance()->getSettings() as $setting): ?>
                <div class="input-field col s6">
                    <input value="<?= $setting->value ?>" id="<?= $setting->key ?>" name="<?= $setting->key ?>" type="text" class="validate">
                    <label for="<?= $setting->key ?>"><?= $setting->name ?></label>
                </div>
            <?php endforeach; ?>
        </div>
        <BUTTON class="btn"><i class="material-icons tiny left">save</i>Сохранить</BUTTON>
    </form>

<?php includeView('layouts\footer');
