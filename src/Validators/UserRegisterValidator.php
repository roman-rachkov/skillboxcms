<?php


namespace App\Validators;

use App\Model\User;
use Valitron\Validator;

class UserRegisterValidator implements iValidator
{
    protected Validator $validator;

    public function __construct(array $data)
    {
        $this->validator = new Validator($data);
    }

    public function validate()
    {
        $this->validator->rule('required', ['username', 'email', 'password', 'confirm_password'])->message('Поле должно быть заполнено');
        $this->validator->rule('email', 'email')->message('Введите валидный Email');
        $this->validator->rule(function ($field, $value, $params, $fields) {
            if (User::where('email', $value)->whereNotNull('username')->first()) {
                return false;
            } else {
                return true;
            }
        }, 'email')->message('Пользователь с таким Email уже зарегистрирован');
        $this->validator->rule(function ($field, $value, $params, $fields) {
            if (User::where('username', $value)->first()) {
                return false;
            } else {
                return true;
            }
        }, 'username')->message('Пользователь с таким логином уже зарегистрирован');
        $this->validator->rule('equals', 'confirm_password', 'password')->message('Пароли не совпадают');
        $this->validator->rule('accepted', 'accept_rules')->message('Надо принять правила сайта');
        $this->validator->rule('lengthMin', 'username', 4)->message('Минимальная длина поля 4 знака');
        $this->validator->rule('lengthMin', 'password', 6)->message('Минимальная длина поля 6 знаков');

        return $this->validator->validate();
    }

    public function errors()
    {
        return $this->validator->errors();
    }
}
