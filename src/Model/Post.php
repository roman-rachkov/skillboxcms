<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable =[
        'title',
        'text',
    ];

    public function author(){
        return $this->hasOne('App\Model\User');
    }

    public function categories(){
        return $this->belongsToMany('App\Model\Category', 'article_category');
    }
}