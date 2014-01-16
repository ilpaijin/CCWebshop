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
    /**
     * Contains all available products
     * @var array
     */
    private $storage = array();

    /**
     * Add product to the active caching layer
     * @param WebshopProductsProduct $product
     */
    public function add(\Webshop\Products\Product $product)
    {
        //possible alternative? $this->storage[spl_object_hash($product)]
        $this->storage[$product->getId()] = $product;
    }

    /**
     * remove product from the active caching layer
     * @param  WebshopProductsProduct $product [description]
     */
    public function remove(\Webshop\Products\Product $product)
    {
        if(isset($this->storage[$product->getId()]))
        {
            unset($this->storage[$product->getId()]);
        }
    } 

    /**
     * Get all products from the active caching layer
     * @return array
     */
    public function getContents()
    {
        return $this->storage;
    }
}   