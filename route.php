<?php

$router->registerRoute('/home', '\App\Controller\HomeController@index');

$router->registerRoute('/', function(){
    $controller = new \App\Controller\HomeController();
    return $controller->index();
});

$router->registerRoute('/test/{{test}}', function(){
    $view = new \App\View\Respond();
    return $view->Display('home');
});