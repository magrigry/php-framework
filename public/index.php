<?php


session_start();

chdir('..');

define('DS', DIRECTORY_SEPARATOR); // meilleur portabilité sur les différents systeme.
define('ROOT', dirname(dirname(__FILE__).DS)); // pour se simplifier la vie

require ROOT.DS . "vendor/autoload.php";

$request = \GuzzleHttp\Psr7\ServerRequest::fromGlobals();
$request->getUri()->withPath(isset($_GET['url']) ? htmlentities($_GET['url']) : '/')->getPath();

$router = \Core\Router\Router::getInstance($request);
require_once (ROOT.DS.'route.php');
$route = $router->match();

\App\Response::set(call_user_func($route->getCallable()), 99);
\App\Response::send();