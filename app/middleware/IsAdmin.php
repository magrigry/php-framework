<?php
/**
 * Created by PhpStorm.
 * User: fornas0q
 * Date: 15/04/2019
 * Time: 16:16
 */

namespace App\middleware;


use Core\Session;
use Core\View\Html;
use GuzzleHttp\Psr7\Response;
use function Http\Response\send;

class IsAdmin
{
    public function index(Response $response, Session $session, Html $html){
        if(!$session->check('isAdmin') || $session->get('isAdmin') != true ){
            $response->getBody()->write($html->render('/errors/unauthorized.php'));
            $response->withStatus(401);
            send($response->withStatus(401));
            die();
        }
    }
}