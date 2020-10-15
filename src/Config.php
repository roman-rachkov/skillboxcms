<?php
/**
 * Created by PhpStorm.
 * User: Acer
 * Date: 24.10.2019
 * Time: 17:41
 */

namespace App;

class Config
{
    private static $instance = null;
    private $configs = [];

    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return self::$instance;
    }

    private function __construct()
    {
        foreach (scandir(CONFIG_DIR) as $file) {
            if (is_dir(CONFIG_DIR . DIRECTORY_SEPARATOR . $file)) {
                continue;
            }
            $this->configs[substr($file, 0, -4)] = require_once CONFIG_DIR . DIRECTORY_SEPARATOR . $file;
        }
    }

    public function get($config, $default = null)
    {
        return arrayGet($this->configs, $config, $default);
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}
