<?php


namespace App\Controller;

class ArticleController extends BaseController
{
    public function indexAction()
    {
        includeView("index");
    }

    public function singleAction(int $id)
    {
        echo "Single: " . $id;
    }
}
