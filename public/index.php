<?php

session_start();

chdir('..');

define('DS', DIRECTORY_SEPARATOR); // meilleur portabilité sur les différents systeme.
define('ROOT', dirname(dirname(__FILE__).DS)); // pour se simplifier la vie

require ROOT.DS . "vendor/autoload.php";

$request = new App\Request(isset($_GET['url']) ? htmlentities($_GET['url']) : '/');

require_once (ROOT.DS.'route.php');

\App\Response::set(call_user_func($request->run()), 99);
\App\Response::send();
