<?php

/************************************************/
/*                       App                    */
/************************************************/
session_start();
chdir('..');
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__).DS));
require ROOT.DS . "vendor/autoload.php";

/************************************************/
/*                       DI                     */
/************************************************/
$containerBuilder = new \DI\ContainerBuilder();
$containerBuilder->addDefinitions(ROOT . DS . 'DI.php');
try{
    $container = $containerBuilder->build();
}catch (Exception $e){
    echo $e;
}


$router = $container->get(\Core\Router\Router::class);
require_once (ROOT.DS.'route.php');
$route = $router->match();



echo call_user_func_array($route->getCallable(), array($container));

