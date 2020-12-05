<?php


namespace App\Exception;

use App\View\Renderable;
use App\View\View;

class AccessDeniedException extends HttpException implements Renderable
{
    public function __construct($message = "")
    {
        parent::__construct($message, 403, null);
    }

    public function render()
    {
        $view = new View('exception', ['exception' => $this]);
        $view->render();
    }
}
