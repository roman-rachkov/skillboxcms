<?php


namespace App\Controller;

use App\Model\Category;

class CategoryController extends BaseController
{
    public function indexAction()
    {
        $root = Category::find(1);
        debug($root);
        $child = new Category();
        $child->name = 'Child 1';
        $child->parent_id = $root->id;
        if($child->save()){
            $moved = $child->hasMoved();
            debug($moved);
        }

        redirect('/category/view');
    }
}
