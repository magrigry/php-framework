<?php

namespace Core\Router;

/**
 * Class Router
 * @package Core
 */
class Router
{

    /**
     * @var
     */
    private $url;
    /**
     * @var
     */
    private $call;

    /**
     * @var
     */
    private $parameters = array();

    /**
     * @var
     */
    private static $_classname;
    /**
     * @var
     */
    private static $_methodName;
    /**
     * @var
     */
    private static $_instance;

    /**
     * @var
     */
    private $error404;


    /**
     * Router constructor.
     * @param $request
     */
    public function __construct($request)
    {
        $this->url = $request;
    }


    /**
     * @param $request
     * @return Router
     */
    public static function getInstance($request) : router
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Router($request);
        }
        return self::$_instance;
    }

    /**
     * @param $path
     * @param $call Callable or string "controller@method"
     * @return $this
     */
    public function newRoute($path, $call) : router
    {

        $path = $path != '/' ? explode('/', rtrim(ltrim($path, '/'), '/')) : '/';
        $url = $this->url != '' ? explode('/', rtrim(ltrim($this->url, '/'), '/')) : '/';
        $returnCall = false;

        if ($this->url == null && $path == '/') {
            $returnCall = true;
        } elseif (is_array($path) && is_array($url) && sizeof($path) == sizeof($url)) {
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

            if (isset($get)) {
                $this->parameters = $get;
            }

            if (is_string($call)) {
                $call2 = explode('@', $call);
                self::$_classname = $call2['0'];
                self::$_methodName = $call2['1'];
                $this->call = function () {
                    $classname = self::
                    $_classname;
                    $methodName = self::$_methodName;
                    $class = new $classname();
                    return $class->$methodName();
                };
            } else {
                $this->call = $call;
            }
        }

        return $this;

    }

    /**
     * @param $callable
     */
    public function error404($callable){
        $this->error404 = $callable;
    }


    /**
     * @return Route
     */
    public function match() : Route
    {
        if (isset($this->call) && !empty($this->call)) {
            return new Route($this->call, $this->parameters);
        }

        if(is_callable($this->error404)){
            return new Route($this->error404, $this->parameters);
        }

        return new Route(function(){ return '404 Error page not found'; }, $this->parameters);

    }

}