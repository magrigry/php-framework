<?php

$router->error404(function(){
   return '404 Page not found';
});

$router->newRoute('/framework/test/{{test}}', '\App\Controller\TestController@index', 'test');

$router->newRoute('/framework/', '\App\Controller\HomeController@index', 'home');

