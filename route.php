<?php

$router->error404(function(){
   return '404 Page not found';
});

$router->newRoute('/test/{{test}}', '\App\Controller\TestController@index', 'test');

$router->newRoute('/', '\App\Controller\HomeController@index', 'home');

