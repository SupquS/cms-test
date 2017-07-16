<?php

namespace Engine\Helper;

/**
 * Class Common
 *
 * @package Engine\Helper
 */
class Common
{
    /**
     * Method checks if http method is POST or not
     *
     * @return boolean
     */
    public function isPost()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return true;
        }

        return false;
    }

    /**
     * Getter for method by using global $_SERVER['REQUEST_METHOD']
     *
     * @return mixed
     */
    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Get path url and return part of a string without '?' anf GET request if exist
     *
     * @return boolean|string
     */
    public function getPathUrl()
    {
        $pathUrl = $_SERVER['REQUEST_URI'];
        if ($position = strpos($pathUrl, '?')) {
            $pathUrl = substr($pathUrl, 0, $position);
        }

        return $pathUrl;
    }
}
