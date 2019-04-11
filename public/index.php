<?php


session_start();

chdir('..');

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__).DS));

require ROOT.DS . "vendor/autoload.php";

$request = \Core\Request::getInstance();
$controller = \Core\Controller::getInstance();

$router = \Core\Router\Router::getInstance(isset($_GET['url']) ? htmlentities($_GET['url']) : '/');
require_once (ROOT.DS.'route.php');
$route = $router->match();

$containerBuilder = new \DI\ContainerBuilder();
$containerBuilder->addDefinitions(ROOT . DS . 'DI.php');

try{
    $container = $containerBuilder->build();
}catch (Exception $e){
    echo $e;
}

echo call_user_func_array($route->getCallable(), array($container));

