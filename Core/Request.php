<?php

namespace Core;

/**
 * Class Request
 * @package Core
 */
class Request
{

    /**
     * @var string
     */
    private $url;

    /**
     * @var array
     */
    private $get = array();

    /**
     * @var array
     */
    private $post = array();

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
     * Request constructor.
     * @param string $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }


    /**
     * @return string
     */
    public function getUrl(){
        return $this->url;
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
