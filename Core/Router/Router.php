<?php

namespace Core\Router;

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
     * @param null $request
     * @return Router
     */
    public static function getInstance($request): router
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Router($request);
        }

        if(is_null(self::$_instance) && is_null($request)){
            trigger_error("<p>Framework error: Parameters $request is null in $routename in Router::getInstance and it's the first instance " . $debug[0]['file'] . " at line " . $debug[0]['line'] . '</p>');
        }
        return self::$_instance;
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

        return \Core\Config::url($path);
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

            foreach ($_GET as $key => $value) {
                $get[$key] = htmlentities($value);
            }

            if (isset($get)) {
                $this->parameters = $get;
                \Core\Request::getInstance()->setGet($get);
            }

            foreach ($_POST as $key => $value) {
                $post[$key] = htmlentities($value);
            }

            if (isset($post)) {
                \Core\Request::getInstance()->setPost($post);
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