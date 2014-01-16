<?php

namespace Webshop\CachingLayer;

/**
* Cache class
*
* @package default
* @author ilpaijin <ilpaijin@gmail.com>
*/
class Cache 
{
    /**
     * Active cache drivers
     * @var array
     */
    public static $drivers = array();

    /**
     * accessor for a driver instance
     * @param  string $driver 
     * @return Webshop\CachingLayer\CachingInterface
     */
    public static function getDriver($driver = null)
    {
        if(is_null($driver)) 
        {
            $driver = 'memory';
        }

        if(!isset(static::$drivers[$driver]))
        {
            static::$drivers[$driver] = static::build($driver);
        }

        return static::$drivers[$driver];
    }

    /**
     * factory for a new driver instance
     * @param  string $driver [description]
     * @return Webshop\CachingLayer\CachingInterface
     */
    public static function build($driver)
    {
        switch($driver)
        {
            case 'memory':
                return new InMemoryCaching();
                break;

            case 'redis': 
                return new RedisCaching();
                break;
            case 'session':
                return new SessionCaching();
                break;       
        }
    }

    /**
     * Magic method used for accessing the concrete implementation
     * @param  $method
     * @param  $parms 
     * @return function \
     */
    public static function __callStatic($method, $parms)
    {
        $default = isset(array_keys(static::$drivers)[0]) ? array_keys(static::$drivers)[0] : '';
        return call_user_func_array(array(static::getDriver($default), $method), $parms );
    }
}   