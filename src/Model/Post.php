<?php


namespace App\Model;


use App\Config;
use App\Request;
use App\Settings;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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

    public function getPerPage()
    {
        $paginate = Request::get('perpage');
        $paginate = is_array($paginate) ? Settings::getInstance()->get('result_per_page',
            Config::getInstance()->get('default.result_per_page')) : $paginate;
        return $paginate;
    }

}