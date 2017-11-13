<?php
class Main extends Core
{
    public function fetch()
    {
        $categories = new Categories();
        $pages = new Pages();
        $categories_catalog = $categories->getCategories();
        $pages_catalog = $pages->getPages();

        $array_vars = array(
            'categories' => $categories_catalog,
            'pages' => $pages_catalog,
        );

        return $this->view->render('main.html',$array_vars);
    }
}