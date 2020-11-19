<?php

namespace App\Controller;

use App\Model\User;
use App\Request;
use App\Validators\UserLoginValidator;
use App\Validators\UserRegisterValidator;
use App\View\View;

class UserController extends BaseController
{
    public function registrationAction()
    {
        $request = Request::post();
        $validator = new UserRegisterValidator();

        if ($validator->validate($request)) {
            $user = new User();
            $user->username = $request['username'];
            $user->email = $request['email'];
            $user->password = password_hash($request['password'], PASSWORD_DEFAULT);
            if ($user->save()) {
                $_SESSION['user'] = $user;
                setSuccess('Добро пожаловать, ' . $user->username . '!');
                redirect('/');
            } else {
                setError('Произошла неизвестная ошибка, пожалуйста обновите страницу и попробуйте снова');
                return new View('registration', ['request' => $request, 'title' => 'Регистрация нового пользователя', 'pageClass' => 'registration', 'errors' => $validator->errors()]);
            }
        } else {
            return new View('registration', ['request' => $request, 'title' => 'Регистрация нового пользователя', 'pageClass' => 'registration', 'errors' => $validator->errors()]);
        }
    }

    public function loginAction()
    {
        $validator = new UserLoginValidator();
        $request = Request::post();

        if ($validator->validate($request)) {
            $_SESSION['user'] = User::where('email', Request::post('email'))->first();
            setSuccess('Добро пожаловать, ' . $_SESSION['user']->username . '!');
            redirect();
        } else {
            debug($validator->errors());
            return new View('login', ['request' => $request, 'title' => 'Вход на сайт', 'pageClass' => 'login', 'errors' => $validator->errors()]);
        }
    }

}
