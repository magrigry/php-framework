<?php

namespace Core;

use Core\Router\Router;
use Core\View\Html;

/**
 * Class Controller
 * @package Core
 */
class Controller
{

    /**
     * @var Html
     */
    public $Html;
    /**
     * @var Request
     */
    public $Request;

    /**
     * @var Router
     */
    public $Router;

    /**
     * @var
     */
    protected static $_instance;

    /**
     * @return Controller
     */
    public static function getInstance(): Controller
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Controller();
        }
        return self::$_instance;
    }

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->Html = Html::getInstance();
        $this->Request = Request::getInstance();
        $this->Router = Router::getInstance();
    }

}
