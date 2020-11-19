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

    protected function __wakeup()
    {
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;
    }
}
