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
        $this->mockCustomer = \Mockery::mock('Webshop\Customer');
        $this->mockProduct = \Mockery::mock('Webshop\Products\Product');

        $this->mockSl
            ->shouldReceive('offsetGet')
            ->twice();

        $this->cart = new Webshop\Cart($this->mockSl);
    }

    public function tearDown()
    {
        $this->caching = null;
        \Mockery::close();
    }

    public function testAddCustomerToCart()
    {
        $this->cart->addCustomer($this->mockCustomer);

        $this->assertEquals($this->mockCustomer, $this->cart->getCustomer());
    }
}