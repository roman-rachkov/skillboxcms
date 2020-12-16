<?php includeView('/layouts/header', compact('title', 'pageClass')); ?>
    <div class="row">
<?php if ($users->hasPages()): ?>
    <div class="col s12 m3">
        <?php includeView('layouts/per_page_select', ['paginator' => $users]); ?>
    </div>
    <div class="col s12 m9">
    <?php else: ?>
    <div class="col s12">
<?php endif; ?>


    <div class="row">

        <table class="highlight centered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Роли</th>
                <th>Действия</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($users as $user): ?>
                    <tr>
                        <td>
                            <?= $user->id ?>
                            <input type="hidden" name="id" value="<?= $user->id ?>">
                        </td>
                        <td><?= $user->username ?></td>
                        <td><?= $user->email ?></td>
                        <td>
                            <select name="roles" multiple>
                                <?php foreach (\App\Model\Role::all() as $role): ?>
                                    <option
                                        value="<?= $role->key ?>" <?= !$user->hasRole($role->key) ?: 'selected' ?>><?= $role->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <a href="/admin/users/update" class="tooltipped update-user" data-tooltip="Сохранить изменения"><i class="material-icons tiny">save</i></a>
                            <a href="/admin/users/edit/<?=$user->id?>" class="tooltipped " data-tooltip="Редактировать пользователя"><i class="material-icons tiny">edit</i></a>
                        </td>
                    </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
    </div>

<?php includeView('layouts/pagination', ['paginator' => $users]); ?>
    </div>
    </div>

<?php includeView('/layouts/footer');
