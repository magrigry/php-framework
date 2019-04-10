<?php

return [
    \Core\Request::class => \Core\Request::getInstance(),
    \Core\View\Html::class => \Core\View\Html::getInstance(),
    \Core\Router\Route::class => \Core\Router\Router::getInstance(isset($_GET['url']) ? htmlentities($_GET['url']) : '/')
];