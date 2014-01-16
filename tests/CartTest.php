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

        $result = array(
            'name' => 'Paio', //SR Principle 
        );

        $this->caching
            ->shouldReceive('getContents')
            ->once()
            ->andReturn($result);

        $this->caching
            ->shouldReceive('add')
            ->with($this->mockProduct)
            ->once();

        $this->cart->addProduct($this->mockProduct);

        $this->assertEquals($result, $this->cart->getCachedContents());
    }

    public function testCanRemoveProductFromCache()
    {
        $result = array('name' => 'John Doe');

        $this->mockProduct = \Mockery::mock('Webshop\Products\Product');
        $this->anotherMockProduct = \Mockery::mock('Webshop\Products\Product');

        $this->caching
            ->shouldReceive('add')
            ->with($this->mockProduct)
            ->once();

        $this->caching
            ->shouldReceive('add')
            ->with($this->anotherMockProduct)
            ->once();    

        $this->caching
            ->shouldReceive('remove')
            ->with($this->mockProduct)
            ->once();    

        $this->caching
            ->shouldReceive('getContents')
            ->once()
            ->andReturn($result);    

        $this->cart->addProduct($this->mockProduct);
        $this->cart->addProduct($this->anotherMockProduct);
        $this->cart->removeProduct($this->mockProduct);

        $this->assertEquals($result, $this->cart->getCachedContents());
    }

    public function testCalculateTotal()
    {
        $contents = array($this->mockProduct);

        $return = 10;

        $this->mockProduct
            ->shouldReceive('getPrice')
            ->once()
            ->andReturn(10)
            ->shouldReceive('getQty')
            ->once()
            ->andReturn(1);            

        $this->caching
            ->shouldReceive('getContents')
            ->once()
            ->andReturn($contents);     

        $this->assertEquals($return, $this->cart->getCachedContentsTotal());
    }
}