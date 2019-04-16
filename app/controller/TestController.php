<?php

namespace App\Controller;

use Core\Router\Route;
use Core\View\Html;
use \Core\App;

class TestController{


    public function index(Html $html, Route $route, App $app){

        /* CREER un HASH */
        $hash = new \Core\Lib\Hash($app);
        $hash->getHash('str');
        $hash->verifyHash('$2y$10$OKFK0TKqLVCSd4IgZKNz8.h20xfW3eYIV5hDjsDB/00IrW6d/OfdK', 'str');

        $errors['testError'] = true;

        /* RETOURNER vue */
        return $html->render('test.php', compact('route', 'errors'));

    }

}