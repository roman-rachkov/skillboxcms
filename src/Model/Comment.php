<?php


namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class Comment extends Model
{
    use SoftDeletes;
    use NodeTrait;

    protected $fillable = [
        'text',
        'moderated',
        'user_id',
        'post_id',
        'parent_id'
    ];

    public function comments()
    {
        return $this->hasMany('App\Model\Comment', 'parent_id');
    }

    public function article()
    {
        return $this->belongsTo('App\Model\Comment', 'post_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'user_id');
    }
}
