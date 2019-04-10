<?php

namespace App\Controller;

use Core\Controller;
use Core\Request;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends Controller
{

    /**
     * @return false|string
     */
    public function index(Request $request)
    {
        
        $this->Html->setPageName('home');
        $this->Html->setTitle('Home page');

        $this->Html->addError("Page inconnue");
        $this->Html->addError("Vous n'avez pas la permission");

        $controller = $this;
        return $this->Html->render('home.php', ['controller' => $this]);

    }

}