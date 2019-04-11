<?php

namespace Core;


/**
 * Class App
 * @package Core
 */
class App
{

    /**
     * @var string
     */
    private $url_protocol = 'http://';
    /**
     * @var string
     */
    private $url_domain = 'localhost';
    /**
     * @var string
     */
    private $url_path = '/framework/public';

    /**
     * @var bool
     */
    private $php_errors = true;

    /**
     * App constructor.
     * @param $config
     */
    public function __construct($config)
    {

        foreach($config as $key => $value){
            $this->$key = $value;
        }

        $this->phpErrors();

    }

    /**
     *
     */
    private function phpErrors()
    {
        if ($this->php_errors == true) {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        }
    }

    /**
     * @param $path
     * @return string
     */
    public function url($path)
    {
        return $this->url_protocol . $this->url_domain . $this->url_path . $path;
    }


}