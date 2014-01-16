<?php

/**
* MonthlyDiscountTest class
*
* @package default
* @author ilpaijin <ilpaijin@gmail.com>
*/
class MonthlyDiscountTest extends PHPUnit_Framework_TestCase
{
    public function setUp ()
    {
        $value = 10;
        $duration = '1 day';
        $this->discount = new Webshop\Products\Discounts\MonthlyDiscount($value, $duration);
    }

    public function tearDown()
    {
        \Mockery::close();
    }

    public function testGetDiscountedPrice()
    {   
        $this->assertEquals(9, $this->discount->getDiscount(10));
    }

    public function testCheckExpirationDiscount()
    {   
        $yesterday = new DateTime('now -1 day');
        $this->assertTrue($this->discount->isExpired($yesterday));
    }
}