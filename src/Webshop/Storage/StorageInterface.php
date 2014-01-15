<?php

namespace Webshop\Storage;

interface StorageInterface 
{
    public function add(\Webshop\Products\ProductInterface $product);   
    public function remove(\Webshop\Products\ProductInterface $product);  
    public function getContents(); 
}