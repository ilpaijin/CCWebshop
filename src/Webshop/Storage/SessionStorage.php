<?php

namespace Storage;

/**
* SessionStorage class
*
* @package default
* @author ilpaijin <ilpaijin@gmail.com>
*/
class SessionStorage 
{
    public function add(\Webshop\Products\Product $product){};   
    public function remove(\Webshop\Products\Product $product){}; 
    public function getContents(){};  
}