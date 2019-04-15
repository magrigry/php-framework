<?php

namespace Core\Router;

use GuzzleHttp\Psr7\ServerRequest;

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
     * @param $request
     * @param $app
     */
    public function __construct(ServerRequest $request, \Core\App $app)
    {
        $this->request = $request;
        $this->app = $app;
        $this->url = $request->getUri()->getPath();
    }

    /**
     * @param $routename
     * @param null $datas
     * @return string
     */
    public function showPath($routename, $datas = null){

        if(!isset($this->routes[$routename])){
            $debug = debug_backtrace();
            trigger_error("<p>Framework error: Undefined index $routename in Router->showPath " . $debug[0]['file'] . " at line " . $debug[0]['line'] . '</p>');
        }

        $path = $this->routes[$routename];

        if(!is_null($datas) && is_array($datas)){
            foreach($datas as $key => $data){
                $path = str_replace('{{'.$key.'}}', $data, $path);
            }
        }

        return $this->app->url($path);
    }

    /**
     * @param $path
     * @param $call Callable or string "controller@method"
     * @param $routename
     * @return $this
     */
    public function newRoute($path, $call, $routename): router
    {

        $this->routes[$routename] = $path;

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
                $this->call = function ($container) {
                    $classname = self::$_classname;
                    $methodName = self::$_methodName;
                    $class = new $classname();
                    return $container->call([$class, $methodName]);
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
            return new Route($this->call, $this->parameters);
        }

        if (is_callable($this->error404)) {
            return new Route($this->error404, $this->parameters);
        }

        return new Route(function () {
            return '404 Error page not found';
        }, $this->parameters);

    }

}