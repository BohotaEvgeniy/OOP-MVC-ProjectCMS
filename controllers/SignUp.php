<?php

class SignUp extends Core
{
    public function fetch()
    {
        $pages = new Pages();
        ////////////////////////////
        $path = '/' . pathinfo($_SERVER['REQUEST_URI'],PATHINFO_BASENAME);

        $array_vars = array(
            'page_whole' => $pages->getPage($path),
            'pages' => $pages->getPages(),
        );

        return $this->view->render('sign_up.html',$array_vars);
    }
}