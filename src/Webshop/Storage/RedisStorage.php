<?php

namespace Webshop\Storage;

/**
* RedisStorage class
*
* @package default
* @author ilpaijin <ilpaijin@gmail.com>
*/
class RedisStorage 
{
    private $instance;
    
    public function add(\Webshop\Products\Product $product){};   
    public function remove(\Webshop\Products\Product $product){}; 
    public function getContents(){};   
}