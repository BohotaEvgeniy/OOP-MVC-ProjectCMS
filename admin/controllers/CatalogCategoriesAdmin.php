<?php
/**
 * Created by PhpStorm.
 * User: Evil Genius
 * Date: 02.11.2017
 * Time: 23:09
 */

class CatalogCategoriesAdmin extends CoreAdmin
{
    public function fetch()
    {

        $categories = new Categories();
        $categories_catalog = $categories->getCategories();


        $array_vars = array(
            'name_category' => 'Categories',
            'categories' => $categories_catalog,
        );

        return $this->view->render('catalog_categories.html',$array_vars);
    }
}