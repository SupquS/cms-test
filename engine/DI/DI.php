<?php

namespace Engine\DI;

/**
 * Class DI Dependency Injection
 *
 * @package Engine\DI
 */
class DI
{

    /**
     * The container where will be stored all Dependencies
     *
     * @var array
     */
    private $container = [];


    /**
     * Getter
     *
     * @param $key $key param
     *
     * @return mixed
     */
    public function get($key)
    {
        return $this->has($key);
    }


    /**
     * Setter
     *
     * @param $key $key first param
     * @param $value $value second param
     *
     * @return $this
     */
    public function set($key, $value)
    {
        $this->container[$key] = $value;

        return $this;
    }


    /**
     * Has checked if $key exists
     *
     * @param $key $key param
     *
     * @return boolean
     */
    public function has($key)
    {
        return isset($this->container[$key]) ? $this->container[$key] : null;
    }
}
