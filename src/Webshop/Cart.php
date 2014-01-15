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
        $this->storage = $sl['InMemoryStorage'];
        $this->persist = $sl['db'];
    }

    public function addProduct(Products\ProductInterface $product)
    {
        $this->storage->add($product);
    }

    public function removeProduct(Products\ProductInterface $product)
    {
        $this->storage->remove($product);
    }

    public function purchase()
    {
        $this->persist->save($this->getStorageContents());

        echo '<p>Thanks for your order</p>';
    }

    public function getStorageContents()
    {
        return $this->storage->getContents();
    }

    public function getPersistContents()
    {
        return $this->persist->getContents();
    }

    public function getStorageTotal()
    {
        $t = '';
        foreach($this->getStorageContents() as $prod)
        {
            $t += $prod->getPrice() * $prod->getQty();
        }

        echo "<h3> Storage Total: " . $t . "</h3>";
    }
}   