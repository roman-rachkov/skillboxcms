<?php

namespace App\Controller;

use App\Model\User;
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
        $validator->rule(function ($field, $value, $params, $fields) {
            if (User::where('email', $value)->first()) {
                return false;
            } else {
                return true;
            }
        }, 'email')->message('Пользователь с таким Email уже зарегистрирован');
        $validator->rule(function ($field, $value, $params, $fields) {
            if (User::where('username', $value)->first()) {
                return false;
            } else {
                return true;
            }
        }, 'username')->message('Пользователь с таким логином уже зарегистрирован');
        $validator->rule('equals', 'confirm_password', 'password')->message('Пароли не совпадают');
        $validator->rule('accepted', 'accept_rules')->message('Надо принять правила сайта');
        $validator->rule('lengthMin', 'username', 4)->message('Минимальная длина поля 4 знака');
        $validator->rule('lengthMin', 'password', 6)->message('Минимальная длина поля 6 знаков');

        if ($validator->validate()) {
            $user = new User();
            $user->username = $request['username'];
            $user->email = $request['email'];
            $user->password = password_hash($request['password'], PASSWORD_DEFAULT);
            if($user->save()){
                $_SESSION['user'] = $user;
                setSuccess('Добро пожаловать, '.$user->username.'!');
                redirect('/');
            } else {
                setError('Произошла неизвестная ошибка, пожалуйста обновите страницу и попробуйте снова');
                return new View('registration', ['request' => $request, 'title' => 'Регистрация нового пользователя', 'pageClass' => 'registration', 'errors' => $validator->errors()]);
            }
        } else {
            debug($validator->errors());
            return new View('registration', ['request' => $request, 'title' => 'Регистрация нового пользователя', 'pageClass' => 'registration', 'errors' => $validator->errors()]);
        }
    }

    public function loginAction()
    {
        $request = Request::post();
        $validator = Request::createValidator($request);

        $user = null;

        $validator->rule('required', ['email', 'password'])->message('Поле должно быть заполнено');
        $validator->rule('email', 'email')->message('Введите валидный Email');
        $validator->rule(function ($field, $value, $params, $fields) use (&$user) {
            $user = User::where('email', $value)->first();
            if ($user) {
                return true;
            } else {
                return false;
            }
        }, 'email')->message('Пользователь не найден');
        $validator->rule(function ($field, $value, $params, $fields) use (&$user) {
            if (password_verify($value, $user->password)) {
                return true;
            } else {
                return false;
            }
        }, 'password')->message('Пара логин/пароль не совпадают');


        if ($validator->validate()) {
            $_SESSION['user'] = $user;
            setSuccess('Добро пожаловать, '.$user->username.'!');
            redirect();
        } else {
            debug($validator->errors());
            return new View('login', ['request' => $request, 'title' => 'Вход на сайт', 'pageClass' => 'login', 'errors' => $validator->errors()]);
        }
    }

}
