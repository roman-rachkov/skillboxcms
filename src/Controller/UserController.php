<?php

namespace App\Controller;

use App\Request;
use App\View\View;

class UserController extends BaseController
{

    public function registrationAction()
    {
        $request = Request::post();
        $validator = Request::createValidator($request);

        $validator->rule('required', ['username', 'email', 'password', 'confirm_password'])->message('Поле должно быть заполнено');
        $validator->rule('email', 'email')->message('Введите валидный Email');
        $validator->rule('equals', 'confirm_password', 'password')->message('Пароли не совпадают');
        $validator->rule('accepted', 'accept_rules')->message('Надо принять правила сайта');
        $validator->rule('lengthMin', 'username', 4)->message('Минимальная длина поля 4 знака');
        $validator->rule('lengthMin', 'password', 6)->message('Минимальная длина поля 6 знаков');

        if ($validator->validate()) {
            debug(true);
        } else {
            debug($validator->errors());
            return new View('registration', ['request' => $request, 'title' => 'Регистрация нового пользователя', 'pageClass' => 'registration', 'errors' => $validator->errors()]);
        }

    }


}