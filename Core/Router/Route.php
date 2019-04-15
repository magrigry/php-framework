<?php
namespace Core\Router;

use Core\App;

/**
 * Class Route
 * @package Core\Router
 */
class Route
{
    /**
     * @var array
     */
    private $routes = Array();

    /**
     * @var
     */
    private $callable;

    /**
     * @var array
     */
    private $parameters = array();

    private $middleWares;

    /**
     * @var App
     */
    private $app;

    /**
     * Route constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    /**
     * @param $routes
     */
    public function setRoutes($routes)
    {
        $this->routes = $routes;
    }

    public function addMiddleWare($value)
    {
        $this->middleWares[] = $value;
    }

    /**
     * @param $callable
     */
    public function setCallable($callable)
    {
        $this->callable = $callable;
    }

    /**
     * @param $parameters
     */
    public function setParams($parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @return callable
     */
    public function getCallable()
    {
        return $this->callable;
    }

    public function getMiddleWares()
    {
        return $this->middleWares;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getParameter($key)
    {
        return $this->parameters[$key];
    }

    /**
     * @param $routeName
     * @param null $datas
     * @return string
     */
    public function showPath($routeName, $datas = null)
    {

        if(!isset($this->routes[$routeName])){
            $debug = debug_backtrace();
            trigger_error("<p>Framework error: Undefined index $routeName in Router->showPath " . $debug[0]['file'] . " at line " . $debug[0]['line'] . '</p>');
        }

        $path = $this->routes[$routeName];

        if(!is_null($datas) && is_array($datas)){
            foreach($datas as $key => $data){
                $path = str_replace('{{'.$key.'}}', $data, $path);
            }
        }

        return $this->app->url($path);
    }

}