<?php

namespace Core;

use mysql_xdevapi\Exception;

class Request
{

    private $get = array();

    private $post = array();

    private static $_instance;

    public function setGet($get)
    {
        $this->get = $get;
    }

    public function setPost($post)
    {
        $this->post = $post;
    }

    public static function getInstance(): Request
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Request();
        }
        return self::$_instance;
    }

    public function get($var)
    {
        if(isset($this->get[$var])){
            return $this->get[$var];
        }
        $debug = debug_backtrace();
        return "<p>Framework warning: Undefined index $var in GET " . $debug[0]['file'] . " at line " . $debug[0]['line'] . '</p>';
    }

    public function post($var)
    {
        if(isset($this->post[$var])){
            return $this->post[$var];
        }
        $debug = debug_backtrace();
        return "<p>Framework warning: Undefined index $var in POST " . $debug[0]['file'] . " at line " . $debug[0]['line'] . '</p>';    }

}
