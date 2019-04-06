<?php

namespace Core;

/**
 * Class Request
 * @package Core
 */
class Request
{

    /**
     * @var array
     */
    private $get = array();

    /**
     * @var array
     */
    private $post = array();

    /**
     * @var
     */
    private static $_instance;

    /**
     * @param $get
     */
    public function setGet($get)
    {
        $this->get = $get;
    }

    /**
     * @param $post
     */
    public function setPost($post)
    {
        $this->post = $post;
    }

    /**
     * @return Request
     */
    public static function getInstance(): Request
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Request();
        }
        return self::$_instance;
    }

    /**
     * @param $var
     * @return mixed|string
     */
    public function get($var)
    {
        if (isset($this->get[$var])) {
            return $this->get[$var];
        }
        $debug = debug_backtrace();
        trigger_error("<p>Framework warning: Undefined index $var in Request->get " . $debug[0]['file'] . " at line " . $debug[0]['line'] . '</p>');
    }

    /**
     * @param $var
     * @return mixed|string
     */
    public function post($var)
    {
        if (isset($this->post[$var])) {
            return $this->post[$var];
        }
        $debug = debug_backtrace();
        trigger_error("<p>Framework warning: Undefined index $var in Request->post " . $debug[0]['file'] . " at line " . $debug[0]['line'] . '</p>');
    }

}
