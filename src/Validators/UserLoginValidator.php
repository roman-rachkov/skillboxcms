<?php


namespace App\Validators;

use App\Model\User;
use Valitron\Validator;

class UserLoginValidator implements iValidator
{
    protected Validator $validator;

    public function __construct(array $data)
    {
        $this->validator = new Validator($data);
    }

    public function validate()
    {
        $user = null;
        $this->validator->rule('required', ['email', 'password'])->message('Поле должно быть заполнено');
        $this->validator->rule('email', 'email')->message('Введите валидный Email');
        $this->validator->rule(function ($field, $value, $params, $fields) use (&$user) {
            $user = User::where('email', $value)->first();
            if ($user) {
                return true;
            }
            return false;
        }, 'email')->message('Пользователь не найден');
        $this->validator->rule(function ($field, $value, $params, $fields) use (&$user) {
            if ($user && !password_verify($value, $user->password)) {
                return false;
            }
            return true;
        }, 'password')->message('Пара логин/пароль не совпадают');
        return $this->validator->validate();
    }

    public function errors()
    {
        return $this->validator->errors();
    }
}
