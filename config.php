<?php

return [

    'config' => [
        'url_protocol' => 'http://',
        'url_domain' => 'localhost',
        'url_path' => '/framework/public',
        'php_errors' => true,
        'sel' => 'lkpomfd!skogfidsjpo' //Change this value for each app
    ],

    \Core\Request::class => \DI\Factory(function($url){return new \Core\Request($url); })
    ->parameter('url', isset($_GET['url']) ? htmlentities($_GET['url']) : '/'),

    \Core\App::class => \DI\Factory(function($config){return new \Core\App($config); })
    ->parameter('config', \DI\get('config')),

    \GuzzleHttp\Psr7\ServerRequest::class => \DI\Factory(function(){return \GuzzleHttp\Psr7\ServerRequest::fromGlobals(); })

];