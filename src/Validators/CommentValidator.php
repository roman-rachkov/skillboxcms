<?php

namespace App\Validators;

use Valitron\Validator;

class CommentValidator implements iValidator
{
    protected $validator;

    public function __construct(array $data)
    {
        $this->validator = new Validator($data);
    }

    public function validate()
    {
        $this->validator->rule('required', ['comment'])->message('Поле не может быть пустым');
        return $this->validator->validate();
    }

    public function errors()
    {
        return $this->validator->errors();
    }

}