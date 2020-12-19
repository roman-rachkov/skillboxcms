<?php


namespace App\Controller\Admin;


use App\Exception\AccessDeniedException;
use App\Request;
use App\Settings;
use App\View\View;

class SettingsController extends BaseController
{

    public function indexAction(){
        return new View('/admin/settings', ['title'=>"Настройки сайта"]);
    }

    public function updateAction(){
        if(!$_SESSION['user']->canDo('edit_settings')){
            throw new AccessDeniedException('Доступ запрещен');
        }
        $post = Request::post();
        foreach ($post as $key=>$value) {
            Settings::getInstance()->set($key, $value);
        }
        setSuccess('Настройки обновлены');
        redirect('/admin/settings');
    }

}