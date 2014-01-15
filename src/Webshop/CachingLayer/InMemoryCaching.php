<?php

namespace Webshop\CachingLayer;

/**
* InMemoryCachingLayer class
*
* @package default
* @author ilpaijin <ilpaijin@gmail.com>
*/
class InMemoryCaching implements CachingInterface
{
    private $storage = array();

    public function add(\Webshop\Products\Product $product)
    {
        //possible alternative? $this->storage[spl_object_hash($product)]
        $this->storage[$product->getId()] = $product;
    }

    public function remove(\Webshop\Products\Product $product)
    {
        if(isset($this->storage[$product->getId()]))
        {
            unset($this->storage[$product->getId()]);
        }
    } 

    public function getContents()
    {
        return $this->storage;
    }
}   