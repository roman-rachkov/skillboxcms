<?php

namespace App;

use App\View\Renderable;
use App\View\View;
use Illuminate\Database\Capsule\Manager as Capsule;

class Application
{
    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
        $this->Initialize();
    }

    public function run()
    {
        try {
            $data = $this->router->dispatch();

            if ($data instanceof Renderable) {
                $data->render();
            } elseif (is_string($data)) {
                echo $data;
            }
        } catch (\Exception $e) {
            $this->renderException($e);
        }
    }

    private function renderException(\Exception $e)
    {
        if ($e instanceof Renderable) {
            $e->render();
        } else {
            echo 'Ошибка: ' . ($e->getCode() === 0 ? 500 : $e->getCode()) . ' ' . $e->getMessage();
        }
    }

    public function getConfig()
    {
        return Config::getInstance();
    }

    private function Initialize()
    {
        $capsule = new Capsule();

        $capsule->addConnection([
            'driver' => DB_DRIVER,
            'host' => $this->getConfig()->get('db.' . DB_DRIVER . '.host'),
            'database' => $this->getConfig()->get('db.' . DB_DRIVER . '.database'),
            'username' => $this->getConfig()->get('db.' . DB_DRIVER . '.user'),
            'password' => $this->getConfig()->get('db.' . DB_DRIVER . '.password'),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}
