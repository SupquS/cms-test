<?php

namespace Engine\Core\Router;

/**
 * Class DispatchedRoute
 *
 * @package Engine\Core\Router
 */
class DispatchedRoute
{

    /**
     * Controller variable
     *
     * @var $controller
     */
    private $controller;

    /**
     * Array of parameters
     *
     * @var array
     */
    private $parameters;

    /**
     * DispatchedRoute constructor.
     *
     * @param $controller| $controller Controller
     * @param $parameters| $parameters Parameters
     */
    public function __construct($controller, $parameters = [])
    {
        $this->controller = $controller;
        $this->parameters = $parameters;
    }

    /**
     * Getter for Controllers
     *
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Getter for Parameters
     *
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }
}
