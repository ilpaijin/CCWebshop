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
    public static $drivers = array();

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

    public static function __callStatic($method, $parms)
    {
        $default = isset(array_keys(static::$drivers)[0]) ? array_keys(static::$drivers)[0] : '';
        return call_user_func_array(array(static::getDriver($default), $method), $parms );
    }
}   