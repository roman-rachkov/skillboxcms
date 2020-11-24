<?php

namespace App\Controller;

use App\Model\Role;
use App\Model\User;
use App\Request;
use App\Validators\UserLoginValidator;
use App\Validators\UserRegisterValidator;
use App\Validators\UserSubscribeValidator;
use App\View\View;

class UserController extends BaseController
{
    public function registrationAction()
    {
        $request = Request::post();
        $validator = new UserRegisterValidator($request);

        if ($validator->validate()) {
            $user = User::where('email', $request['email'])->first();
            if (!$user) {
                $user = new User();
                $user->email = $request['email'];
            }
            $user->username = $request['username'];
            $user->password = password_hash($request['password'], PASSWORD_DEFAULT);
            if ($user->save()) {
                $user->roles()->attach(Role::where('key', 'user')->first());
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
        $request = Request::post();
        $validator = new UserLoginValidator($request);

        if ($validator->validate()) {
            $_SESSION['user'] = User::where('email', Request::post('email'))->first();
            setSuccess('Добро пожаловать, ' . $_SESSION['user']->username . '!');
            redirect();
        } else {
            debug($validator->errors());
            return new View('login', ['request' => $request, 'title' => 'Вход на сайт', 'pageClass' => 'login', 'errors' => $validator->errors()]);
        }
    }

    public function subscribeAction()
    {
        if (isset($_SESSION['user'])) {
            $user = User::find($_SESSION['user']->id);
        } else {
            $post = Request::post();
            $validator = new UserSubscribeValidator($post);
            if ($validator->validate()) {
                $user = new User();
                $user->email = $post['email'];
            } else {
                debug($validator->errors());
                foreach ($validator->errors()['email'] as $error) {
                    setError('Ошибка при подписке - ' . $error);
                }
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
        $user->subscribed = true;
        setSuccess('Подписска оформлена!');
        $user->save();
        if (isset($_SESSION['user'])) {
            $_SESSION['user'] = $user;
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function unsubscribeAction()
    {

    }

}
