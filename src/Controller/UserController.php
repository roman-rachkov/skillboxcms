<?php

namespace App\Controller;

use App\Exception\AccessDeniedException;
use App\Exception\NotFoundException;
use App\Model\Role;
use App\Model\User;
use App\Request;
use App\Validators\UserLoginValidator;
use App\Validators\UserRegisterValidator;
use App\Validators\UserSubscribeValidator;
use App\Validators\UserUpdateInfoValidator;
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

    public function viewRegistrationAction(){
        return new View('registration', ['title' => 'Регистрация нового пользователя', 'pageClass' => 'registration']);
    }

    public function logoutAction(){
        session_destroy();
        redirect();
    }

    public function viewLoginAction(){
        return new App\View\View('login', ['title' => 'Вход на сайт', 'pageClass' => 'login']);
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
                foreach ($validator->errors()['email'] as $error) {
                    setError('Ошибка при подписке - ' . $error);
                }
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
        $user->subscribed = true;
        setSuccess('Подписка оформлена!');
        $user->save();
        if (isset($_SESSION['user'])) {
            $_SESSION['user'] = $user;
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function unsubscribeAction()
    {
        if (isset($_SESSION['user'])) {
            $user = User::find($_SESSION['user']->id);
        } else {
            setError("Пожалуйста авторизуйтесь");
            redirect('/login');
        }
        $user->subscribed = false;
        setSuccess('Подписка удалена!');
        $user->save();
        $_SESSION['user'] = $user;
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function updateAction(int $id = null)
    {
        if (!isset($_SESSION['user'])) {
            throw new AccessDeniedException('Доступ запрещен');
        }
        $user = User::find($id);
        $data = Request::post();
        $validator = new UserUpdateInfoValidator($data);

        if ($validator->validate()) {
            $user->username = $data['username'];
            $user->about = $data['about'];
            $user->email = $data['email'];

            $avatar = tryToUploadFile('avatar', 'avatars', ['image/png', 'image/jpeg', 'image/gif'], '2M');

            if ($avatar) {
                $user->avatar = DIRECTORY_SEPARATOR . 'avatars' . DIRECTORY_SEPARATOR . $avatar['name'];
            }

            if ($user->save()) {
                setSuccess('Данные успешно обновлены');
                if ($user->id == $_SESSION['user']->id) {
                    $_SESSION['user'] = $user;
                }
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                setError('Что то пошло не так');
            }
        }
        return new View('profile', ['errors' => $validator->errors(), 'request' => $data, 'user' => $user]);
    }

    public function profileAction(int $id = null)
    {
        $user = User::find($id) ?? ($_SESSION['user'] ?? null);
        if (!$user) {
            setError('Пожалуйста авторизуйтесь');
            redirect('/login');
        }
        return new View('profile', ['user' => $user]);
    }
}
