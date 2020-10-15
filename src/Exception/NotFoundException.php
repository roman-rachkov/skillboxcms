<?php
/**
 * Created by PhpStorm.
 * User: Acer
 * Date: 22.10.2019
 * Time: 14:41
 */

namespace App\Exception;

use App\View\Renderable;
use Throwable;

class NotFoundException extends HttpException implements Renderable
{
    public function __construct($message = "")
    {
        parent::__construct($message, 404, null);
    }

    public function render()
    {
        echo 'Упссс.... ' . $this->getCode() . ' ' . $this->getMessage();
    }
}
