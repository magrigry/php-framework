<?php

namespace Core\Router;

use GuzzleHttp\Psr7\ServerRequest;
use \Core\App;

/**
 * Class Router
 * @package Core
 */
class Router
{

    /**
     * @var array
     */
    private $routes = Array();

    /**
     * @var Route
     */
    private $Route;

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
    private $error404;

    /**
     * @var
     */
    private $request;

    /**
     * @var
     */
    private $app;


    /**
     * Router constructor.
     * @param ServerRequest $request
     * @param App $app
     * @param Route $Route
     */
    public function __construct(ServerRequest $request, App $app, Route $Route)
    {
        $this->request = $request;
        $this->app = $app;
        $this->url = $request->getUri()->getPath();
        $this->Route = $Route;
    }

    /**
     * @param $path
     * @param $call Callable or string "controller@method"
     * @param $routeName
     * @param middleWare
     * @return $this
     */
    public function newRoute($path, $call, $routeName, $middleWares = null): router
    {
        $this->routes[$routeName] = $path;

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

            if(is_array($middleWares)){
                foreach ($middleWares as $middleWare){
                    $this->Route->addMiddleWare($middleWare);
                }
            }

            if (isset($get)) {
                $this->parameters = $get;
            }

            if (is_string($call)) {
                $call2 = explode('@', $call);
                self::$_classname = $call2['0'];
                self::$_methodName = $call2['1'];
                $this->call = function () {
                    $classname = self::$_classname;
                    $methodName = self::$_methodName;
                    $class = new $classname();
                    return Array($class, $methodName);
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
    public function error404($callable)
    {
        $this->error404 = $callable;
    }


    /**
     * @return Route
     */
    public function match(): Route
    {
        if (isset($this->call) && !empty($this->call)) {
            $this->Route->setRoutes($this->routes);
            $this->Route->setParams($this->parameters);
            $this->Route->setCallable($this->call);
            return $this->Route;
        }

        if (is_callable($this->error404)) {
            $this->Route->setRoutes($this->routes);
            $this->Route->setCallable($this->error404);
            return $this->Route;
        }
        $this->Route->setCallable(
            function(){return '404';}
            );
        return $this->Route;

    }

}