<?php

namespace App\Controller;

use Core\Controller;

class HomeController extends Controller
{

    public function index()
    {

        $test = "test";
        $page = $this->Request->get('test');

        $this->Html->setPageName('home');
        $this->Html->setTitle('Home page');

        $this->Html->addError("Page inconnue");
        $this->Html->addError("Vous n'avez pas la permission");

        return $this->Html->render('home.php', compact("test", "page"));

    }

}