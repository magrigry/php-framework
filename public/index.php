<?php


session_start();

chdir('..');

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__).DS));

require ROOT.DS . "vendor/autoload.php";

$router = \Core\Router\Router::getInstance(isset($_GET['url']) ? htmlentities($_GET['url']) : '/');
require_once (ROOT.DS.'route.php');
$route = $router->match();


\App\Response::set(call_user_func($route->getCallable()), 99);
\App\Response::send();