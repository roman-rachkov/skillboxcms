<?php


namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\Model\User', 'user_role');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Model\Permission', 'permission_role');
    }
}
