<?php


namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

//    protected $table = 'articles';

    protected $fillable = [
        'title',
        'text',
        'img_src',
        'type'
    ];

    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Model\Category');
    }

    public function comments()
    {
        return $this->hasMany('App\Model\Comment');
    }
}
