<?php


namespace App\Controller\Admin;


use App\Exception\HttpException;

class BaseController extends \App\Controller\BaseController
{

    public function __construct()
    {
        if(!isset($_SESSION['user']) || !$_SESSION['user']->canDo('view_admin')){
            throw new HttpException('Доступ запрещен', 403);
        }
    }

}