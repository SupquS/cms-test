<?php

namespace Engine\Service\Router;

use Engine\Core\Router\Router;
use Engine\Service\AbstractProvider;

/**
 * Class Provider
 *
 * @package Engine\Service\Database
 */
class Provider extends AbstractProvider
{

    /**
     * Variable with Service name
     *
     * @var string
     */
    public $serviceName = 'router';


    /**
     * Init DB connection
     *
     * @inheritdoc
     */
    public function init()
    {
        $router = new Router();
        $this->di->set($this->serviceName, $router);
    }
}
