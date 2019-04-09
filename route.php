<?php

$router->error404(function(){
   return '404 Page not found';
});

$router->newRoute('/test/{{test}}', '\App\Controller\HomeController@index', 'test');

$router->newRoute('/', '\App\Controller\HomeController@index', 'home');

