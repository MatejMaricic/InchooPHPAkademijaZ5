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


        if (file_exists($controllersPath.$controller. '.php') && class_exists($controller) && method_exists($controller, $action)) {
            $controllerInstance = new $controller();
            $controllerInstance ->$action();
            var_dump($controller);
        } else {

            header("HTTP/1.0 404 Not Found");

        }
    }

}