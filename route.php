<?php

$router->error404(function(){
   return '404 Page not found';
});

$router->new('/home', '\App\Controller\HomeController@index');

$router->new('/', function(){
    $controller = new \App\Controller\HomeController();
    return $controller->index();
});

$router->new('/test/{{test}}', function(){
    return 'test2';
});