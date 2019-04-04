<?php
namespace Core\Router;

/**
 * Class Route
 * @package Core\Router
 */
class Route
{

    /**
     * @var
     */
    private $callable;
    /**
     * @var array
     */
    private $parameters = array();

    /**
     * Route constructor.
     * @param $callable
     * @param $parameters
     */
    public function __construct($callable, $parameters)
    {
        $this->callable = $callable;
        $this->parameters = $parameters;
    }

    /**
     * @return callable
     */
    public function getCallable() {
        return $this->callable;
    }

    /**
     * @return array
     */
    public function getParameters() {

        return $this->parameters;

    }
}