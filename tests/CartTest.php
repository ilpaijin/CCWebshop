<?php

/**
* CartTest class
*
* @package default
* @author ilpaijin <ilpaijin@gmail.com>
*/
class CartTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->mockDb = \Mockery::mock('Webshop\PersistanceLayer\SqlLitePersist');
        $this->caching = \Mockery::mock('Webshop\CachingLayer\InMemoryCaching');
        $this->mockCustomer = \Mockery::mock('Webshop\Customer');
        $this->mockProduct = \Mockery::mock('Webshop\Products\Product');

        $this->cart = new Webshop\Cart($this->mockDb, $this->caching);
    }

    public function tearDown()
    {
        $this->mockDb = null;
        $this->caching = null;
        $this->mockCustomer = null;
        $this->mockProduct = null;
        \Mockery::close();
    }

    public function testCanAddCustomerToCart()
    {
        $this->cart->addCustomer($this->mockCustomer);

        $this->assertEquals($this->mockCustomer, $this->cart->getCustomer());
    }

    public function testCanAddProductToCache()
    {

        $result = array();

        $this->caching
            ->shouldReceive('getContents')
            ->once()
            ->andReturn($result);

        $this->caching
            ->shouldReceive('add')
            ->with($this->mockProduct)
            ->once();

        $this->cart->addProduct($this->mockProduct);

        $this->assertEquals(array(), $this->cart->getCachedContents());
    }
}