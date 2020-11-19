<?php


namespace App\Validators;

interface iValidator
{
    public function validate(array $data);
    public function errors();
}