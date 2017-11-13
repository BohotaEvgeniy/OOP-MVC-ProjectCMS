<?php
/**
 * Created by PhpStorm.
 * User: Evil Genius
 * Date: 02.11.2017
 * Time: 23:21
 */

class CategoryAdmin extends CoreAdmin
{
    public function fetch()
    {
        $categories = new Categories();
        $request = new Request();
        ////////////////////////////
        $category = new stdClass();

        if($request->method() == 'POST') {

            $category->name = $request->post('name');
            $category->visible = $request->post('visible','integer');
            $category->image = $request->files('image','name');
            $request->uploadImgFile('image');


            if($request->post('id','integer')) {
                $id = $categories->updateCategory($request->post('id','integer'),$category);

            } else {
                //Добавление товара
                $id = $categories->addCategory($category);
            }

            $category = $categories->getCategory($id);
        }
        $array_vars = array(
            'category' => $category,
            'backUp' => "Back",
        );

        return $this->view->render('category.html',$array_vars);
    }
}