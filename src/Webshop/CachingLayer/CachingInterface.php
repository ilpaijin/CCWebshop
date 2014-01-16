<?php

namespace Webshop\CachingLayer;

interface CachingInterface 
{
    /**
     * Add product to the active caching layer
     * @param WebshopProductsProduct $product
     */
    public function add(\Webshop\Products\Product $product);   

    /**
     * remove product from the active caching layer
     * @param  WebshopProductsProduct $product [description]
     */
    public function remove(\Webshop\Products\Product $product);  

    /**
     * Get all products from the active caching layer
     * @return array
     */
    public function getContents(); 
}