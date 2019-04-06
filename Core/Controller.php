<?php

namespace Core;

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
    protected $Html;
    /**
     * @var Request
     */
    protected $Request;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->Html = Html::getInstance();
        $this->Request = Request::getInstance();
    }

}
