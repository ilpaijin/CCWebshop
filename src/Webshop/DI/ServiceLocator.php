<?php

namespace Webshop\DI;

use \Closure;

/**
* SL class
*
* @package default
* @author ilpaijin <ilpaijin@gmail.com>
*/
class ServiceLocator implements \ArrayAccess
{
    /**
     * Contains the deps
     * @var array
     */
    protected $deps = array();

    /**
     * Share a single instance of a Class (singleton principle) 
     * @param  Closure $callback
     * @return object $unique
     */
    public static function share(Closure $callback)
    {
        return function($c) use ($callback)
        {
            static $unique;

            if(is_null($unique))
            {
                $unique = $callback($c);
            }

            return $unique;
        };
    }

    /**
     * {@link offsetSet}
     */
    public function offsetSet($key, $value)
    {
        $this->deps[$key] = $value;
    }

    /**
     * {@link offsetGet}
     */
    public function offsetGet($key)
    {
        if(!isset($this->deps[$key]))
        {
            throw new \InvalidArgumentException("key $key not found in deps");
        }

        if(is_callable($this->deps[$key]))
        {
            return $this->deps[$key]($this);
        }
        
        return $this->deps[$key];
    }

    /**
     * {@link offsetExists}
     */
    public function offsetExists($key)
    {
        return isset($this->deps[$key]) ?: false;
    }

    /**
     * {@link offsetUnset}
     */
    public function offsetUnset($key)
    {
        if(!isset($this->deps[$key]))
        {
            throw new \InvalidArgumentException("key $key not found in deps");
        }

        unset($this->deps[$key]);
    }
}