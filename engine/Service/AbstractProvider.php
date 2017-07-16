<?php

namespace Engine\Service;

use Engine\DI\DI;

/**
 * Class AbstractProvider
 *
 * @package Engine\Service
 */
abstract class AbstractProvider
{
    
    /**
     * Hold instance of DI class
     *
     * @var $di \Engine\DI\DI;
     */
    protected $di;

    /**
     * AbstractProvider constructor.
     *
     * @param DI $di instance of DI class
     */
    public function __construct(DI $di)
    {
        $this->di = $di;
    }

    /**
     * Abstract method to initialize new Service
     *
     * @return mixed
     */
    abstract protected function init();
}
