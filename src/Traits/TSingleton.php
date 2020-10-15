<?php

namespace App\Traits;

trait TSingleton
{
    private static $instance;

    protected function __construct()
    {
    }

    protected function __clone()
    {
    }

    public function __wakeup()
    {
        throw new \Exception("Синглтон не должен быть востанавливаем");
    }

    public static function getInstance() : TSingleton
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;
    }
}
