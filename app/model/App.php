<?php

final class App
{

    public static function  start()
    {
        $pathInfo = Request::pathInfo();
        $pathInfo = trim($pathInfo, '/');
        $pathParts = explode('/', $pathInfo);
        $controllersPath = BP . 'app/controller/';


        if (!isset($pathParts[0]) || empty($pathParts[0])){
            $controller = 'Index';
        }else {
            $controller = ucfirst(strtolower($pathParts[0]));
        }
        $controller .= 'Controller';


        if (!isset($pathParts[1]) || empty($pathParts[1])){
            $action = 'index';
        }else {
            $action = strtolower($pathParts [1]);
        }



        if (file_exists($controllersPath.$controller. '.php')) {

           if (class_exists($controller) && method_exists($controller, $action)) {

               $controllerInstance = new $controller();
               $controllerInstance ->$action();

           }elseif (class_exists($controller) && !method_exists($controller,$action)){

               header("HTTP/1.0 404 Not Found");

           }

           else {
               $controller = 'IndexController';
               $action = 'index';
               $controllerInstance = new $controller();
               $controllerInstance ->$action();


           }




        } else {

            if (!$action || ($action === 'index' && $controller = 'IndexController')){

                $controller = 'IndexController';
                $controllerInstance = new $controller();
                $controllerInstance ->$action();


            }else {

                    header("HTTP/1.0 404 Not Found");
            }


        }
    }

}