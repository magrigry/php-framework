<?php

/************************************************/
/*                       init                    */
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
$containerBuilder->addDefinitions(ROOT . DS . 'config.php');
try{
    $container = $containerBuilder->build();
}catch (Exception $e){
    echo $e;
}

/************************************************/
/*                    ROUTER                    */
/************************************************/
try{
    $router = $container->get(\Core\Router\Router::class);
}catch(Exception $e){
    echo 'index.php' . __LINE__ . ' ' . $e;
}
require_once (ROOT.DS.'route.php');
$route = $router->match();

/************************************************/
/*                  MiddleWare                  */
/************************************************/

require_once (ROOT.DS.'middleware.php');
if(!is_null($route->getMiddleWares())){
    foreach($route->getMiddleWares() as $key => $value){
        $call = explode('@', $value);
        $className = 'App\\Middleware\\' . $call[0];
        $methodName = $call[1];
        $container->call([$className, $methodName]);
    }
}

/************************************************/
/*                   Execution                  */
/************************************************/
$exec = $container->call($route->getCallable());
if(is_callable($exec)){
    $body = $container->call($exec);
}
else{
    $body = $exec;
}

/************************************************/
/*                   Response                   */
/************************************************/
if(is_string($body)){
    try{
        $psrResponse = $container->get(\GuzzleHttp\Psr7\Response::class);
    }catch(Exception $e){
        echo 'index.php' . __LINE__ . ' ' . $e;
    }
    $psrResponse->getBody()->write($body);
    \Http\Response\send($psrResponse);
}elseif($body instanceof  \GuzzleHttp\Psr7\Response){
    \Http\Response\send($body);
}
