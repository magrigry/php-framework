<?php

namespace App;

use Controller\HomeController;

class Request extends ObjectArrayAccess
{

    private $url;
    private $call;
    public static $classname;
    public static $methodname;


    public function __construct($url)
    {
        $this->url = $url;
    }

    public function isConnected(){
        $view = new View\Html();
        return $view->Respond('home');
    }

    public function registerRoute($path, $call)
    {
        //On supprime les '/' en début et fin de chaine si le chemin n'est pas uniquement égal à "/",
        // et on fait de $path un tableau
        $path = $path != '/' ? explode('/', rtrim(ltrim($path, '/'), '/')) : '/';
        $url = $this->url != '' ? explode('/', rtrim(ltrim($this->url, '/'), '/')) : '/';
        $returnCall = false;

        if($this->url == null && $path == '/'){
            $returnCall = true;
        }

        elseif (is_array($path) && is_array($url) && sizeof($path) == sizeof($url)) {
            foreach ($path as $key => $value) {
                if (isset($path[$key], $url[$key]) && $path[$key] == $url[$key]) {
                    $returnCall = true;
                } elseif (isset($path[$key], $url[$key]) && preg_match('/\{\{(.*)\}\}/', $path[$key], $matches)) {
                    $returnCall = true;
                    $get[$matches['1']] = htmlentities($url[$key]);
                } else {
                    $returnCall = false;
                    break;
                }
            }
        }

        if ($returnCall) {
            foreach ($_POST as $key => $value) {
                $post[$key] = htmlentities($value);
            }

            if (isset($get)) {
                self::$data['get'] = $get;
            }
            if (isset($post)) {
                self::$data['post'] = $post;
            }

            if(is_string($call)){
                $call2 = explode('@', $call);
                self::$classname = $call2['0'];
                self::$methodname =  $call2['1'];
                $this->call = function(){

                    $classname = \App\Request::$classname;
                    $methodname = \App\Request::$methodname;

                    $class = new $classname();

                    return $class->$methodname();

                };
            }else{
                $this->call = $call;
            }
        }

        return $this;

    }


    public function run()
    {
        if (isset($this->call) && !empty($this->call)) {
            return $this->call;
        } else {

            return function () {
                new AppError('404', 'Page introuvable');
            };
        }

    }

}