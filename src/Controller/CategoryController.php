<?php


namespace App\Controller;

use App\Model\Category;
use Kalnoy\Nestedset\NodeTrait;

class CategoryController extends BaseController
{
    public function indexAction()
    {

        Category::fixTree();


        redirect('/category/view');
    }
}
