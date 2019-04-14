<?php

namespace App\Controller;

use Core\Request;
use Core\Router\Router;
use Core\View\Html;
use \Core\App;

class TestController{


    public function index(Html $html, Request $request, Router $router, App $app){

        /* CREER un HASH */
        $hash = new \Core\Lib\Hash($app);
        $hash->getHash('str');
        $hash->verifyHash('$2y$10$OKFK0TKqLVCSd4IgZKNz8.h20xfW3eYIV5hDjsDB/00IrW6d/OfdK', 'str');

        /* RETOURNER vue */
        $html->setPageName('test');
        $html->setTitle('Test page');
        $html->addError("Page inconnue");
        $html->addError("Vous n'avez pas la permission");
        return $html->render('test.php', compact('request', 'request', 'router'));

    }

}