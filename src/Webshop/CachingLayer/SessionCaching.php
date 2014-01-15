<?php

namespace CachingLayer;

/**
* SessionCachingLayer class
*
* @package default
* @author ilpaijin <ilpaijin@gmail.com>
*/
class SessionCaching implements CachingInterface
{
    public function add(\Webshop\Products\Product $product){};   
    public function remove(\Webshop\Products\Product $product){}; 
    public function getContents(){};  
}