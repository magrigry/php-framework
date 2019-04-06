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

        throw new \Exception("index '$var' not found ");

    }

    public function post($var)
    {
        return (isset($this->post[$var])) ? $this->post[$var] : null;
    }

}
