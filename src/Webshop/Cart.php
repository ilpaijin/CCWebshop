<?php

namespace Webshop;

use Webshop\DI\ServiceLocator;

/**
* Cart class
*
* @package default
* @author ilpaijin <ilpaijin@gmail.com>
*/
class Cart 
{
    public $id;

    protected $storage;

    protected $persist;

    protected $sl;

    public function __construct(ServiceLocator $sl)
    {
        $this->sl = $sl;
        $this->storage = $sl['InMemoryCachingLayer'];
        $this->persist = $sl['db'];
    }

    public function addProduct(Products\Product $product)
    {
        $this->storage->add($product);
    }

    public function removeProduct(Products\Product $product)
    {
        $this->storage->remove($product);
    }

    public function purchase()
    {
        $this->persist->save($this->getCachedContents());

        echo '<p>Thanks for your order</p>';
    }

    public function getCachedContents()
    {
        return $this->storage->getContents();
    }

    public function getPersistContents()
    {
        return $this->persist->getContents();
    }

    public function getCachedContentsTotal()
    {
        $t = '';
        foreach($this->getCachedContents() as $prod)
        {
            $t += $prod->getPrice() * $prod->getQty();
        }

        echo "<h3> Cached Total: " . $t . "</h3>";
    }
}   