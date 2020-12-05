<?php


namespace App\Validators;

use App\Model\User;
use Valitron\Validator;

class UserUpdateInfoValidator extends UserRegisterValidator
{
    public function validate(): bool
    {
        $this->validator->rule('required', ['username', 'email'])->message('Поле должно быть заполнено');
        $this->validator->rule('email', 'email')->message('Введите валидный Email');
        $this->validator->rule(function ($field, $value, $params, $fields) {
            $user = User::where('email', $value)->whereNotNull('username')->first();
            if ($user && ($user->id != $_SESSION['user']->id || !$_SESSION['user']->canDo('edit_user'))) {
                debug($_SESSION['user']->canDo('edit_users'));
                return false;
            } else {
                return true;
            }
        }, 'email')->message('Этот Email Принадлежит другому пользователю');
        $this->validator->rule(function ($field, $value, $params, $fields) {
            $user =User::where('username', $value)->first();
            if ($user && ($user->id != $_SESSION['user']->id || !$_SESSION['user']->canDo('edit_user'))) {
                return false;
            } else {
                return true;
            }
        }, 'username')->message('Этот никнейм принадлежит другому пользователю');
        $this->validator->rule('lengthMin', 'username', 4)->message('Минимальная длина поля 4 знака');

        return $this->validator->validate();
    }
}
