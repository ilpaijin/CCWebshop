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
            ->once();

        $this->cart = new Webshop\Cart($this->mockSl);
    }

    public function tearDown()
    {
        $this->mockSl = null;
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
        $this->mockProduct
            ->shouldReceive('getId')
            ->once();

        $this->caching
            ->shouldReceive('add')
            ->with($this->mockProduct)
            ->once();

        $this->cart->addProduct($this->mockProduct);

        // $this->assertEquals($this->mockCustomer, $this->cart->getCustomer());
    }
}