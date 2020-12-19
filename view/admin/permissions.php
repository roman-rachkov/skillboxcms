<?php includeView('layouts/header', ['title' => $title]); ?>

    <form class="row" method="post" action="/admin/permissions">

        <table class="col s12 highlight responsive-table centered">
            <thead>
            <tr>
                <th></th>
                <?php foreach ($roles as $role): ?>
                    <th><?= $role->name ?></th>
                <?php endforeach; ?>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($permissions as $permission): ?>
                <tr>
                    <td><b><?= $permission->name ?></b></td>
                    <?php foreach ($roles as $role): ?>
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

