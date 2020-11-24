<?php


namespace App\Validators;


use Valitron\Validator;

class ArticleValidator implements iValidator
{
    protected Validator $validator;


    public function __construct(array $data)
    {
        $this->validator = new Validator($data);
    }

    public function validate()
    {
        $this->validator->rule('required', ['title', 'text'])->message('Поле не может быть пустым');
        return $this->validator->validate();
    }

    public function errors()
    {
        return $this->validator->errors();
    }
}