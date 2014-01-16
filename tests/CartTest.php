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
        $this->mockSl = \Mockery::mock('Webshop\DI\ServiceLocator');
        $this->caching = \Mockery::mock('Webshop\CachingLayer\InMemory');
        $this->mockCustomer = \Mockery::mock('Webshop\Customer');
        $this->mockProduct = \Mockery::mock('Webshop\Products\Product');

        $this->mockSl
            ->shouldReceive('offsetGet')
            ->twice()
            ->shouldReceive('offsetSet')
            ->twice();

        $this->cart = new Webshop\Cart($this->caching);
    }

    public function tearDown()
    {
        $this->caching = null;
        \Mockery::close();
    }

    public function testCanAddCustomerToCart()
    {
        $this->cart->addCustomer($this->mockCustomer);

        $this->assertEquals($this->mockCustomer, $this->cart->getCustomer());
    }

    public function testCanAddProductToCache()
    {
        $this->caching
            ->shouldReceive('add')
            ->with($this->mockProduct)
            ->once();

        $this->cart->addProduct($this->mockProduct);

        // $this->assertEquals($this->mockCustomer, $this->cart->getCustomer());
    }
}