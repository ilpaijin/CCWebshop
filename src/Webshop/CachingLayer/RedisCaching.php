<?php

namespace Webshop\CachingLayer;

use Redis;

/**
* RedisCaching class
*
* @package default
* @author ilpaijin <ilpaijin@gmail.com>
*/
class RedisCaching implements CachingInterface
{
    private $redis;

    public function __construct()
    {
        try
        {
            $this->redis = new Redis();
            $this->redis->connect('127.0.0.1', 6379);
        } catch(RedisException $e)
        {
            return $e->getMessage();
        }

        $this->redis->delete('prd');

    }
    
    public function add(\Webshop\Products\Product $product)
    {
        $this->redis->zAdd('prd', $product->getId(), serialize($product));
    }

    public function remove(\Webshop\Products\Product $product)
    {
        $this->redis->delete('prd', $product->getId());
    }

    public function getContents()
    {
        $all = $this->redis->zRange('prd', 0, -1);

        return array_map(function($i)
        {
            return unserialize($i);
        }, $all);
    }
}