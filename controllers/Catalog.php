<?php

class Catalog extends Core
{
    public function fetch()
    {
        $page = new Products();
        $category = new Categories();
        $categories = new Categories();
        $pages = new Pages();
        $categories_catalog = $categories->getCategories();
        $pages_catalog = $pages->getPages();
        $path = pathinfo($_SERVER['REQUEST_URI'],PATHINFO_BASENAME);
        $categoryProduct = $category->getCategoryId($path);

        $array_vars = array(
            'list_product' => $page->getProductCategory($categoryProduct['id']),
            'categories' => $categories_catalog,
            'pages' => $pages_catalog,
        );

        return $this->view->render('list.html',$array_vars);
    }
}