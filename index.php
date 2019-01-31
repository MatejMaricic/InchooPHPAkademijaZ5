<?php

define('BP', __DIR__ . '/');
define('MODEL_PATH', 'app/model');
define('CONTROLLER_PATH', 'app/controller');

error_reporting(E_ALL);
ini_set('display_errors', 1);


$includePaths = implode(PATH_SEPARATOR, array(
    BP . MODEL_PATH,
    BP . CONTROLLER_PATH

));

set_include_path($includePaths);

spl_autoload_register(function ($class) {


   $classPath = strtr($class, '\\', DIRECTORY_SEPARATOR) . '.php';

   return include $classPath;
});

App::start();