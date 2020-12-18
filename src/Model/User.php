<?php


namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['email', 'password', 'username'];

    public function roles()
    {
        return $this->belongsToMany('App\Model\Role', 'user_role');
    }

    public function articles()
    {
        return $this->hasMany('App\Model\Post');
    }
    public function comments()
    {
        return $this->hasMany('App\Model\Comment');
    }

    /**
     * Проверяет обладает ли пользователь опеределенной или набором ролей
     * @param mixed $permission string | array
     * @param bool $require если true, то вернет истину только в случае если у пользователя есть все права передеанные в массиве
     * @return bool
     */
    public function canDo($permission, $require = false): bool
    {
        if (is_array($permission)) {
            foreach ($permission as $perm) {
                $perm = $this->canDo($perm);
                if ($perm && !$require) {
                    return true;
                } elseif ($require && !$perm) {
                    return false;
                }
            }
            return true;
        } else {
            foreach ($this->roles as $role) {
                foreach ($role->permissions as $perm) {
                    if (strtolower($perm->key) === strtolower($permission)) {
                        return true;
                    }
                }
            }
        }
        return false;
    }


    /**
     * Проверяет обладает ли пользователь определенной ролью
     * @param mixed $roleName string | array
     * @param bool $require если true, то вернет истину только в случае если у пользователя есть все роли передеанные в массиве
     * @return bool
     */
    public function hasRole($roleName, $require = false): bool
    {
        if (is_array($roleName)) {
            foreach ($roleName as $name) {
                $name = $this->hasRole($name);
                if ($name && !$require) {
                    return true;
                } elseif ($require && !$name) {
                    return false;
                }
            }
            return true;
        } else {
            foreach ($this->roles as $role) {
                if (strtolower($role->key) === strtolower($roleName)) {
                    return true;
                }
            }
        }
        return false;
    }
}
