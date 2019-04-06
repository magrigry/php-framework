<?php

namespace Core;


/**
 * Class Config
 * @package Core
 */
class Config
{

    /**
     * @var string
     */
    private static $url_protocol = 'http://';
    /**
     * @var string
     */
    private static $url_domain = 'localhost';
    /**
     * @var string
     */
    private static $url_path = '/framework/public';

    /**
     * @var bool
     */
    private static $php_errors = true;

    /**
     * Config constructor.
     * @param $config
     */
    public function __construct($config)
    {

        isset($config['url_protocol']) AND self::$url_protocol = $config['url_protocol'];
        isset($config['url_domain']) AND self::$url_domain = $config['url_domain'];
        isset($config['url_path']) AND self::$url_path = $config['url_path'];

        isset($config['php_errors']) AND self::$php_errors = $config['php_errors'];

        $this->phpErrors();

    }

    /**
     *
     */
    private function phpErrors()
    {
        if (self::$php_errors == true) {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        }
    }

    /**
     * @param $path
     * @return string
     */
    public static function url($path)
    {
        return self::$url_protocol . self::$url_domain . self::$url_path . $path;
    }


}