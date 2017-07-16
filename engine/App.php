<?php

namespace Engine;

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

    /**
     * App constructor.
     *
     * @param $di $di Dependency Injection
     */
    public function __construct($di)
    {
        $this->di = $di;
    }

    /**
     * Method to run our Application
     *
     */
    public function run()
    {
    }
}
