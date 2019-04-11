<?php

return [
    \Core\Request::class => \Core\Request::getInstance(),
    \Core\View\Html::class => \Core\View\Html::getInstance(),

    \Core\Router\Router::class => \DI\Factory(function($request){
        return new \Core\Router\Router($request);
    })->parameter('request', isset($_GET['url']) ? htmlentities($_GET['url']) : '/')
];