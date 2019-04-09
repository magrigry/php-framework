<?php

namespace App\Controller;

use Core\Controller;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends Controller
{

    /**
     * @return false|string
     */
    public function index()
    {

        $test = "test";
        $page = $this->Request->get('test');

        var_dump($this->Request);

        $this->Html->setPageName('home');
        $this->Html->setTitle('Home page');

        $this->Html->addError("Page inconnue");
        $this->Html->addError("Vous n'avez pas la permission");

        $router = $this->Router;

        $controller = $this;

        return $this->Html->render('home.php', compact('router', 'page', 'test', 'controller'));

    }

}