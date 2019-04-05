<?php

namespace App\Controller;

use \Core\View\Html;

class HomeController{

    public function index(){

        $test = 'test';
        $view = new Html('home');

        $view->errors[] = "Vous n'avez pas accès à cette page.";

        return $view->send('home.php', compact($test));

    }

}