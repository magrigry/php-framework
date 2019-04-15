<?php

namespace App\Middleware;

use Core\App;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use function Http\Response\send;

class WithoutSlash{


    public function __construct()
    {

    }

    public static function index(ServerRequest $request, Response $response, App $app)
    {

        if($app->getConfig('url_path')[-1] == '/'){
            $rootAppUrl = $app->getConfig('url_path');
        }else{
            $rootAppUrl = $app->getConfig('url_path') . '/';
        }

        if($request->getUri()->getPath() != $rootAppUrl
            && $request->getUri()->getPath()[-1] == "/"
        ){
            $newUrl = $app->url(substr($request->getUri()->getPath(), 0, -1));
            $response = $response->withStatus(301)->withHeader('Location', $newUrl);
            send($response);
            die();
        }
    }

}