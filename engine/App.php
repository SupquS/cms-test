<?php

namespace Engine;

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
        $this->router->add('home', '/', 'HomeController:index');
        $this->router->add('user', '/user/12', 'UserController:index');
        $routerDispatch = $this->router->dispatch((new Common)->getMethod(), (new Common)->getPathUrl());
        print_r($routerDispatch);
    }
}
