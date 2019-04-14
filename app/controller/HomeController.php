<?php

namespace App\Controller;

use Core\Request;
use Core\Router\Router;
use Core\View\Html;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController
{


    /**
     * @param Html $html
     * @param Request $request
     * @param Router $router
     * @return false|string
     */
    public function index(Html $html)
    {
        $html->setPageName('home');
        $html->setTitle('Home page');
        return $html->render('home.php');
    }

}