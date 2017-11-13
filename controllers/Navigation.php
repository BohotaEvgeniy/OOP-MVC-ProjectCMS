<?php
class Navigation extends Core
{
    public function fetch()
    {
        $pages = new Pages();
        $pages_catalog = $pages->getPages();
        var_dump($pages_catalog);
        $array_vars = array(
            'pages' => $pages_catalog,
        );

       // return $this->view->render('navigation.html',$array_vars);
    }
}