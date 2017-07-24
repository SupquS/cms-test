<?php

namespace Engine;

use Engine\Core\Router\DispatchedRoute;
use Engine\Helper\Common;

/**
 * Class App
 *
 * @package Engine
 */
class App
{

    /**
     * Private var to be injected
     *
     * @var $di
     */
    private $di;

    public $router;

    /**
     * App constructor.
     *
     * @param $di $di Dependency Injection
     */
    public function __construct($di)
    {
        $this->di = $di;
        $this->router = $this->di->get('router');
    }

    /**
     * Method to run our Application
     *
     */
    public function run()
    {
        try {
            $this->router->add('home', '/', 'HomeController:index');
            $this->router->add('user', '/user/12', 'UserController:index');
            $this->router->add('news_single', '/news/(id:int)', 'HomeController:news');
            $routerDispatch = $this->router->dispatch((new Common)->getMethod(), (new Common)->getPathUrl());

            if ($routerDispatch == null) {
                $routerDispatch = new DispatchedRoute('ErrorController:page404');
            }

            list($class, $action) = explode(':', $routerDispatch->getController(), 2);

            $controller = '\\Cms\\Controller\\' . $class;
            $parameters = $routerDispatch->getParameters();
            call_user_func_array([new $controller($this->di), $action], $parameters);
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit();
        }
    }
}
