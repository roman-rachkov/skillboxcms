<?php


namespace App\Controller\Admin;

use App\Config;
use App\Exception\AccessDeniedException;
use App\Model\Permission;
use App\Model\Role;
use App\Model\User;
use App\Request;
use App\Settings;
use App\View\View;

class UserController extends BaseController
{
    public function indexAction()
    {
        if (!$_SESSION['user']->canDo('edit_user')) {
            throw new AccessDeniedException('Доступ запрещен');
        }

        $type = Request::get('type');
        $type = is_array($type) ? 'all' : $type;
        $role = Request::get('role');
        $role = is_array($role) ? 'all' : $role;

        $users = null;
        if ($type == 'subscribed') {
            $users = User::where('subscribed', true);
        } elseif ($type == 'published') {
            $users = User::where('unsubscribed', false);
        }
        if ($role != 'all') {
            $users = $users?->whereHas('roles', function ($query) use ($role) {
                    $query->where('key', '=', $role);
                }) ?? User::whereHas('roles', function ($query) use ($role) {
                    $query->where('key', '=', $role);
                });
        }

        $paginate = Request::get('perpage');
        $paginate = is_array($paginate) ? Settings::getInstance()->get(
            'result_per_page',
            Config::getInstance()->get('default.result_per_page')
        ) : $paginate;

        $page = Request::get('page');
        $page = is_array($page) ? 1 : $page;

        if ($paginate != 'all') {
            $users = $users?->paginate($paginate, page: $page)?->setPath('/admin/users') ?? User::paginate($paginate, page: $page)->setPath('/admin/users');
        } else {
            $users = $users?->all() ?? User::all();
        }
        return new View(
            'admin/users_list',
            [
                'title' => "Список Пользователей",
                'pageClass' => 'admin',
                'users' => $users
            ]
        );

    }

    public function permissionsAction()
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']->canDo('moderate_comments')) {
            throw new \App\Exception\AccessDeniedException('Доступ запрещен!');
        }

        $data = Request::post();

        foreach ($data as $role => $permissions) {
            $role = Role::where('key', $role)->first();

            $role->permissions()->detach();

            foreach ($permissions as $permission) {
                $permission = Permission::where('key', $permission)->first();
                $role->permissions()->attach($permission);
            }
        }

        setSuccess('Права успешно обновлены');
        redirect('/admin/permissions');
    }

    public function updateAction()
    {

        if (!$_SESSION['user']->canDo('edit_user')) {
            setError('Доступ запрещен');
        }

        $post = Request::post();
        debug($post);
        $user = User::find($post['id']);

        if (!$user) {
            setError('Пользователь не найден');
        } else {
            $user->roles()->detach();

            foreach ($post['values'] as $value){
                $role = Role::where('key', $value)->first();
                $user->roles()->attach($role);
            }
            setSuccess('Роли пользователя '.$user->username.' успешно обновлены');
        }


        die('success');
    }

}
