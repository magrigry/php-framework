<?php

$router->error404(function(){
   return '404 Page not found';
});

$router->newRoute('/test/{{test}}', function(){
    return 'test2';
});

$router->newRoute('/', '\App\Controller\HomeController@index');

