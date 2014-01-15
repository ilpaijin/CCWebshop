<?php

namespace Webshop\Storage;

/**
* InMemoryStorage class
*
* @package default
* @author ilpaijin <ilpaijin@gmail.com>
*/
class InMemoryStorage implements StorageInterface
{
    private $storage = array();

    public function add(\Webshop\Products\ProductInterface $product)
    {
        //possible alternative? $this->storage[spl_object_hash($product)]
        $this->storage[$product->getId()] = $product;
    }

    public function remove(\Webshop\Products\ProductInterface $product)
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