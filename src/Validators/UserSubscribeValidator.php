<?php


namespace App\Validators;


use App\Model\User;
use Valitron\Validator;

class UserSubscribeValidator implements iValidator
{

    protected Validator $validator;

    public function __construct(array $data)
    {
        $this->validator = new Validator($data);
    }

    public function validate()
    {
        $this->validator->rule('required', 'email')->message('Поле является обязательным к заполнению');
        $this->validator->rule('email', 'email')->message('Email адрес должен быть настоящим');
        $this->validator->rule(function ($field, $value, $params, $fields) {
            if (User::where('email', $value)->first()) {
                return false;
            } else {
                return true;
            }
        }, 'email')->message('Email должен быть уникальным');
        return $this->validator->validate();
    }

    public function errors()
    {
        return $this->validator->errors();
    }
}