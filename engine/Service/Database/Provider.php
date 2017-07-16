<?php

namespace Engine\Service\Database;

use Engine\Core\Database\Connection;
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
    public $serviceName = 'db';


    /**
     * Init DB connection
     *
     * @inheritdoc
     */
    public function init()
    {
        $db = new Connection();
        $this->di->set($this->serviceName, $db);
    }
}
