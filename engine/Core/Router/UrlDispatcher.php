<?php

namespace Engine\Core\Router;

/**
 * Class UrlDispatcher
 *
 * @package Engine\Core\Router
 */
class UrlDispatcher
{
    /**
     * Http methods we used
     *
     * @var array
     */
    private $method = [
        'GET',
        'POST'
    ];

    /**
     * Array of Routes where key is http method
     *
     * @var array
     */
    private $routes = [
        'GET' => '',
        'POST' => ''
    ];

    /**
     * Patterns to be apply
     *
     * @var array
     */
    private $patterns = [
        'int' => '[0-9]+',
        'str' => '[a-zA-Z\.\-_%]+',
        'any' => '[a-zA-Z0-9\.\-_%]+'
    ];

    /**
     * Returns boolean if isset http method in our array or returns empty array
     *
     * @param $method| $method http method
     *
     * @return array|mixed
     */
    private function routes($method)
    {
        return isset($this->routes[$method]) ? $this->routes[$method] : [];
    }

    public function register($method, $pattern, $controller)
    {
        $this->routes[strtoupper($method)][$pattern] = $controller;
    }

    /**
     * Add pattern
     *
     * @param $key|     $key     Key of array
     * @param $pattern| $pattern Pattern value
     */
    public function addPattern($key, $pattern)
    {
        $this->patterns[$key] = $pattern;
    }

    /**
     * Gets all routes of exact method then check && create new Dispatched Route && transmit there our controller ($uri)
     *
     * @param $method| $method http method
     * @param $uri|    $uri    URI after user request
     *
     * @return DispatchedRoute
     */
    public function dispatch($method, $uri)
    {
        $routes = $this->routes(strtoupper($method));
        if (array_key_exists($uri, $routes)) {
            return new DispatchedRoute($routes[$uri]);
        }

        return $this->doDispatch($method, $uri);
    }

    private function doDispatch($method, $uri)
    {
        foreach ($this->routes($method) as $route => $controller) {
            $pattern = '#^' . $route . '$#s';

            if (preg_match($pattern, $uri, $parameters)) {
                return new DispatchedRoute($controller, $parameters);
            }
        }
    }
}
