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
        $this->cart = new Webshop\Cart;
        $this->mockSl = \Mockery::mock('Webshop\DI\ServiceLocator');
        $this->mockCustomer = \Mockery::mock('Webshop\Customer');
        $this->mockProduct = \Mockery::mock('Webshop\Products\Product');
    }

    public function tearDown()
    {
        $this->caching = null;
        \Mockery::close();
    }

    public function testAddCustomerToCart()
    {
        $this->cart->addCustomer($this->mockCustomer);

        $this->assertAttributeContains('customer', $this->ca);
    }
}