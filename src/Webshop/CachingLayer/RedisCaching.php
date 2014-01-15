<?php

namespace Webshop\CachingLayer;

/**
* RedisCachingLayer class
*
* @package default
* @author ilpaijin <ilpaijin@gmail.com>
*/
class RedisCaching implements CachingInterface
{
    private $instance;
    
    public function add(\Webshop\Products\Product $product){};   
    public function remove(\Webshop\Products\Product $product){}; 
    public function getContents(){};   
}