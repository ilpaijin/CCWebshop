<?php

namespace Webshop;

use Webshop\DI\ServiceLocator;
use Webshop\Helpers\Faker;
use Webshop\CachingLayer;
use \Datetime;

/**
* Cart class
*
* @package default
* @author ilpaijin <ilpaijin@gmail.com>
*/
class Cart 
{
    public $id;

    protected $createdAt;

    protected $caching;

    protected $persist;

    protected $customer;
    
    protected $sl;

    public function __construct(ServiceLocator $sl, CachingInterface $caching = null)
    {
        $this->sl = $sl;
        $this->caching = $caching ?: $sl['memoryCaching']; //$sl['redisCaching'];
        $this->persist = $sl['db'];
        $this->createdAt = new Datetime('now');
    }

    public function addCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function addProduct(Products\Product $product)
    {
        $this->caching->add($product);
    }

    public function removeProduct(Products\Product $product)
    {
        $this->caching->remove($product);
    }

    public function purchase()
    {
        $this->persist->save($this->getCachedContents());

        echo '<p>Thanks for your order</p>';
    }

    public function getCachedContents()
    {
        return $this->caching->getContents();
    }

    public function getPersistContents()
    {
        return $this->persist->getContents();
    }

    public function getCachedContentsTotal()
    {
        echo "Cache used: " .get_class($this->caching);
 
        $t = '';
        foreach($this->getCachedContents() as $prod)
        {
            $t += $prod->getPrice() * $prod->getQty();
        }

        echo "<h3> Cached Total: " . Faker::monetize($t) . "</h3>";
    }
}   