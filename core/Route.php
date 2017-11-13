<?php
class Route
{
    public static function run()
    {
        $models_dir = 'models/';
        $controllers_dir = 'controllers/';

        $url = parse_url($_SERVER['REQUEST_URI']);

        $uri_array = array(
            '/' => 'Main',
            '/catalog/' => 'Catalog',
            '/signin/' => 'SignIn',
            '/signup/' => 'SignUp',
        );

        if($url['path']) {

            if(@file_exists($controllers_dir.$uri_array[$url['path']] . '.php')) {
                require $controllers_dir.$uri_array[$url['path']] . '.php'; //controllers/Main.php
                $controller = new $uri_array[$url['path']](); // new Main();

                if(method_exists($controller,'fetch')) {
                    print $controller->fetch();
                } else {
                    Route::error404();
                }
           } elseif($url) {
                require 'controllers/Catalog.php';
                $controller = new Catalog();

                if(method_exists($controller,'fetch')) {
                    print $controller->fetch();
                } else {
                    Route::error404();
                }
            } else {
                require 'controllers/Page.php';
                $controller = new Page();

                if(method_exists($controller,'fetch')) {
                    print $controller->fetch();
                } else {
                    Route::error404();
                }
            }

        }
    }

    public static function error404()
    {
        //здесь будет 404
    }
}