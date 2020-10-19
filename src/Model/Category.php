<?php


namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/**
 * @property  parent_id
 * @property string name
 */
class Category extends Model
{
    use NodeTrait;

    protected $fillable =[
        'name',
        '_lft',
        '_rgt',
        'parent_id'
    ];

    public function subCategories(){
        return $this->hasMany('App\Model\Category', 'parent_id');
    }

}
