<?php

namespace App\Controller;

use Core\Controller;
use Core\Request;

use Core\Router\Router;
use Core\View\Html;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends Controller
{


    /**
     * @param Html $html
     * @param Request $request
     * @param Router $router
     * @return false|string
     */
    public function index(Html $html, Request $request, Router $router, \Core\App $app)
    {

        /* CREER un HASH */
        $hash = new \Core\Lib\Hash($app);
        $hash->getHash('str');
        $hash->verifyHash('$2y$10$OKFK0TKqLVCSd4IgZKNz8.h20xfW3eYIV5hDjsDB/00IrW6d/OfdK', 'stfdr');

        /* RETOURNER vue */
        $html->setPageName('home');
        $html->setTitle('Home page');
        $html->addError("Page inconnue");
        $html->addError("Vous n'avez pas la permission");
        return $html->render('home.php', compact('request', 'request', 'router'));

    }

}