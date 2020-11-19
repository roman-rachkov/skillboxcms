<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
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
}