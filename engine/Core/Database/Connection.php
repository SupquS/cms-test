<?php

namespace Engine\Core\Database;

/**
 * Class Connection to DB
 *
 * @package Engine\Core\Database
 */
class Connection
{

    /**
     * Variable consists connection to DB
     *
     * @var $link
     */
    private $link;

    /**
     * Connection constructor.
     */
    public function __construct()
    {
        $this->connect();
    }

    /**
     * Establish DB connection
     *
     * @return $this
     */
    private function connect()
    {
        $config = require_once __DIR__ . '/../../config.php';

        $dsn = "mysql:host={$config['host']};dbname={$config['db_name']};charset={$config['charset']}";

        $this->link = new \PDO($dsn, $config['username'], $config['password']);

        return $this;
    }

    /**
     * Execute prepared SQL query
     *
     * @param $sql| $sql SQL query
     *
     * @return mixed
     */
    public function execute($sql)
    {
        $st = $this->link->prepare($sql);

        return $st->execute();
    }


    /**
     * Return Assoc or empty Array as a result
     *
     * @param $sql| $sql SQL query
     *
     * @return array
     */
    public function query($sql)
    {
        $st = $this->link->prepare($sql);
        $st->execute();

        $result = $st->fetchAll(\PDO::FETCH_ASSOC);

        if ($result === false) {
            return [];
        }

        return $result;
    }
}
