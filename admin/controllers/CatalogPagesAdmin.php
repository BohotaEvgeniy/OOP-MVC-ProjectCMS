<?php

class CatalogPagesAdmin extends CoreAdmin
{
    public function fetch()
    {

        $pages = new Pages();
        $pages_catalog = $pages->getPages();

        $array_vars = array(
            'name_page' => 'Pages',
            'pages' => $pages_catalog,
        );

        return $this->view->render('catalog_pages.html',$array_vars);
    }
}