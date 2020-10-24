<?php


namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function roles()
    {
        return $this->belongsToMany('App\Model\Role', 'permission_role');
    }
}
