<?php

namespace Core;


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
     * Router constructor.
     * @param $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * @param $url
     * @return Router
     */
    public static function getInstance($url)
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Router($url);
        }
        return self::$_instance;
    }

    /**
     * @param $path
     * @param $call Callable or string "controller@method"
     * @return $this
     */
    public function registerRoute($path, $call)
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

            if (is_string($call)) {
                $call2 = explode('@', $call);
                self::$_classname = $call2['0'];
                self::$_methodName = $call2['1'];
                $this->call = function () {
                    $classname = \Core\Router::$_classname;
                    $methodname = \Core\Router::$_methodName;
                    $class = new $classname();
                    return $class->$methodname();
                };
            } else {
                $this->call = $call;
            }
        }

        return $this;

    }


    /**
     * @return \Closure
     */
    public function run()
    {
        if (isset($this->call) && !empty($this->call)) {
            return $this->call;
        }

        return function () {
            new AppError('404', 'Page introuvable');
        };

    }

}