<?php

return [

    \Core\Request::class => \DI\Factory(function($url){return new \Core\Request($url); })
    ->parameter('url', isset($_GET['url']) ? htmlentities($_GET['url']) : '/'),
    
];