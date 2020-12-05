<?php
/**
 * Created by PhpStorm.
 * User: Acer
 * Date: 22.10.2019
 * Time: 14:40
 */

namespace App\Exception;

use Throwable;

class HttpException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        http_response_code($code);
    }
}
