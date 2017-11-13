<?php

class SignIn extends Core
{
    public function fetch()
    {
        $categories = new Registration();

        $array_vars = array(
            'pages' => 'Hello',
        );

        return $this->view->render('sign_in.html',$array_vars);
    }
}