<?php

namespace App\middleware;


use GuzzleHttp\Psr7\Response;

class PopupExample
{

    public function index(Response $response)
    {
        $response->getBody()->write('<p>Hey je suis un popup ajouté par mon middleware PopupExample !</p>');
    }

}