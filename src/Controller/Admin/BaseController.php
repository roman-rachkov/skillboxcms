<?php


namespace App\Controller\Admin;


use App\Exception\AccessDeniedException;
use App\Exception\HttpException;

class BaseController extends \App\Controller\BaseController
{

    public function __construct()
    {
        if(!isset($_SESSION['user']) || !$_SESSION['user']->canDo('view_admin')){
            throw new AccessDeniedException('Доступ запрещен');
        }
    }

}