<?php

namespace Webshop;

use Webshop\DI\ServiceLocator;
use Webshop\CachingLayer\Cache;
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
    /**
     * CArt id (unused)
     * @var int
     */
    public $id;

    /**
     * Date of creation
     * @var dateTime
     */
    protected $createdAt;

    /**
     * Contains the cache instance
     * @var Webshop\CachingLayer\CachingInterface
     */
    protected $caching;

    /**
     * Contains the persistance instance
     * @var Webshop\PersistanceLayer\PersistanceInterface
     */
    protected $persist;

    /**
     * Contains the Customer instance
     * @var Webshop\Customer
     */
    protected $customer;

    /**
     * Create a new instance
     * @param PersistanceLayerPersistanceInterface $db      
     * @param CachingLayerCachingInterface         $caching 
     */
    public function __construct(PersistanceLayer\PersistanceInterface $db, CachingLayer\CachingInterface $caching)
    {
        $this->caching = $caching;
        $this->persist = $db;
        $this->createdAt = new Datetime('now');
    }

    /**
     * Mutator for adding Customer to this cart instance
     * @param Customer $customer
     */
    public function addCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Accessor for getting the Customer instance
     * @return Customer $customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Mutator for adding Product to this cart instance
     * @param ProductsProduct $product
     */
    public function addProduct(Products\Product $product)
    {
        $this->caching->add($product);
    }

    /**
     * Remove Product from the caching layer
     * @param ProductsProduct $product
     */
    public function removeProduct(Products\Product $product)
    {
        $this->caching->remove($product);
    }

    /**
     * Send the cached instance to the persistance layer
     * @return void
     */
    public function purchase()
    {
        $this->persist->save($this->getCachedContents());

        echo '<p>Thanks for your order</p>';
    }

    /**
     * Return the cached instance array
     * @return array 
     */
    public function getCachedContents()
    {
        return $this->caching->getContents();
    }

    /**
     * Return the persisted instance array
     * @return array 
     */
    public function getPersistContents()
    {
        return $this->persist->getContents();
    }

    /**
     * Get the total from the cached layer
     * @return float
     */
    public function getCachedContentsTotal()
    { 
        $t = '';
        foreach($this->getCachedContents() as $prod)
        {
            $t += $prod->getPrice() * $prod->getQty();
        }

        return $t;
    }
}   