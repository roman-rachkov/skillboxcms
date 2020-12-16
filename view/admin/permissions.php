<?php includeView('layouts/header', ['title' => $title]); ?>

    <form class="row" method="post" action="/admin/permissions">

        <table class="col s12 highlight responsive-table centered">
            <thead>
            <tr>
                <th></th>
                <?php foreach ($permissions as $permission): ?>
                    <th><?= $permission->name ?></th>
                <?php endforeach; ?>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($roles as $role): ?>
                <tr>
                    <td><b><?= $role->name ?></b></td>
                    <?php foreach ($permissions as $permission): ?>
                        <td>
                            <label>
                                <input type="checkbox" name="<?=$role->key?>[]"
                                       value="<?= $permission->key ?>" <?= !$role->permissions->contains($permission) ?'': 'checked' ?>>
                                <span></span>
                            </label>
                        </td>
                    <?php endforeach; ?>
                </tr>

            <?php endforeach; ?>

            </tbody>
        </table>
        <br>
        <button class="btn col m2 s12" type="submit">Сохранить</button>
    </form>

<?php includeView('layouts/footer');?>

