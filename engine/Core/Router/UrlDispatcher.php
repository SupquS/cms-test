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

    /**
     * Method to register our Controllers
     *
     * @param $method|     $method     Method
     * @param $pattern|    $pattern    Pattern
     * @param $controller| $controller Controller
     */
    public function register($method, $pattern, $controller)
    {
        $convert = $this->convertPattern($pattern);
        $this->routes[strtoupper($method)][$convert] = $controller;
    }

    /**
     * Use preg_replace to convert (id:int) into int
     *
     * @param $pattern| $pattern Pattern
     *
     * @return mixed
     */
    private function convertPattern($pattern)
    {
        if (strpos($pattern, '(') === false) {
            return $pattern;
        }

        return preg_replace_callback('#\((\w+):(\w+)\)#', [$this, 'replacePattern'], $pattern);
    }

    /**
     * Replace patterns key with patterns value e.g. replace 'int' with '[0-9]+'
     *
     * @param $matches| $matches Matches
     *
     * @return string
     */
    private function replacePattern($matches)
    {
        return '(?<' . $matches[1] . '>' . strtr($matches[2], $this->patterns) . ')';
    }

    /**
     * Unset all matches when array key is int
     *
     * @param $parameters| $parameters Parameters
     *
     * @return mixed
     */
    private function processParam($parameters)
    {
        foreach ($parameters as $k => $v) {
            if (is_int($k)) {
                unset($parameters[$k]);
            }
        }

        return $parameters;
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

    /**
     * Returns DispatchedRoute
     *
     * @param $method| $method Method
     * @param $uri|    $uri    URI
     *
     * @return DispatchedRoute
     */
    private function doDispatch($method, $uri)
    {
        foreach ($this->routes($method) as $route => $controller) {
            $pattern = '#^' . $route . '$#s';

            if (preg_match($pattern, $uri, $parameters)) {
                return new DispatchedRoute($controller, $this->processParam($parameters));
            }
        }
    }
}
