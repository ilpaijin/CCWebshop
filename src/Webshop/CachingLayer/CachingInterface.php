<?php

namespace Webshop\CachingLayer;

interface CachingInterface 
{
    public function add(\Webshop\Products\Product $product);   
    public function remove(\Webshop\Products\Product $product);  
    public function getContents(); 
}