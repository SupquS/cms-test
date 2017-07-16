<?php

namespace Engine\Core\Router;

/**
 * Class Router
 *
 * @package Engine\Core\Router
 */
/**
 * Class Router
 *
 * @package Engine\Core\Router
 */
class Router
{

    /**
     * Array of Routes we will use
     *
     * @var array
     */
    private $routes = [];

    /**
     * Host which be used in constructor
     *
     * @var $host
     */
    private $host;

    /**
     * @var $dispatcher
     */
    private $dispatcher;

    /**
     * Router constructor.
     *
     * @param $host| $host param
     */
    public function __construct($host)
    {
        $this->host = $host;
    }

    /**
     * Add method gives us possibility to add required routes
     *
     * @param $key|        $key        key of array
     * @param $pattern|    $pattern    pattern e.g. '/'
     * @param $controller| $controller controller name e.g. 'home'
     * @param string|     $method     method by default
     */
    public function add($key, $pattern, $controller, $method = 'GET')
    {
        $this->routes[$key] = [
            'pattern' => $pattern,
            'controller' => $controller,
            'method' => $method
        ];
    }

    /**
     * @param $method| $method Method
     * @param $uri|    $uri    URI
     *
     * @return DispatchedRoute
     */
    public function dispatch($method, $uri)
    {
        return $this->getDispatcher()->dispatch($method, $uri);
    }

    /**
     * @return UrlDispatcher
     */
    public function getDispatcher()
    {
        if ($this->dispatcher == null) {
            $this->dispatcher = new UrlDispatcher();

            foreach ($this->routes as $route) {
                $this->dispatcher->register($route['method'], $route['pattern'], $route['controller']);
            }
        }

        return $this->dispatcher;
    }
}
