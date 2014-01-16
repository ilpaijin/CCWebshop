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
    /**
     * Handle to the Redis connection
     * @var Redis
     */
    private $redis;

    /**
     * Create new Redis connection
     */
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
    
    /**
     * Add product to the active caching layer
     * @param WebshopProductsProduct $product
     */    
    public function add(\Webshop\Products\Product $product)
    {
        $this->redis->zAdd('prd', $product->getId(), serialize($product));
    }

    /**
     * remove product from the active caching layer
     * @param  WebshopProductsProduct $product [description]
     */
    public function remove(\Webshop\Products\Product $product)
    {
        $this->redis->delete('prd', $product->getId());
    }

    /**
     * Get all products from the active caching layer
     * @return array
     */
    public function getContents()
    {
        $all = $this->redis->zRange('prd', 0, -1);

        return array_map(function($i)
        {
            return unserialize($i);
        }, $all);
    }
}