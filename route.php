<?php

$request->registerRoute('/home', '\App\Controller\HomeController@index');

$request->registerRoute('/', function(){
    $controller = new \App\Controller\HomeController();
    return $controller->index();
});

$request->registerRoute('/test/{{test}}', function(){
    $view = new \App\View\Respond();
    return $view->Display('home');
});