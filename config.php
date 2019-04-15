<?php

return [

    'config' => [
        'url_protocol' => 'http://',
        'url_domain' => 'localhost',
        'url_port' => '8080',
        'url_path' => '/framework/public',
        'php_errors' => true,
        'sel' => 'lkpomfd!skogfidsjpo' //Change this value for each app
    ],

    \Core\App::class => \DI\Factory(
        function($config){
            return new \Core\App($config);
        })
    ->parameter('config', \DI\get('config')),

    \Core\Session::class => \DI\Factory(
        function($session){
            return new \Core\Session($session);
        })
        ->parameter('session', $_SESSION),

    \GuzzleHttp\Psr7\ServerRequest::class => \DI\Factory(
        function(){
            return \GuzzleHttp\Psr7\ServerRequest::fromGlobals();
        })

];