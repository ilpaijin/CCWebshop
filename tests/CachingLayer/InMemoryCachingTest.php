<?php

/**
* InMemoryCachingTest class
*
* @package default
* @author ilpaijin <ilpaijin@gmail.com>
*/
class InMemoryCachingTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->caching = new Webshop\CachingLayer\InMemoryCaching;
        $this->mockProduct = \Mockery::mock('\Webshop\Products\Product');
    }

    public function tearDown()
    {
        $this->caching = null;
        \Mockery::close();
    }

    public function testAddsToCache()
    {
        $this->mockProduct
            ->shouldReceive('getId')
            ->once()
            ->andReturn(1);

        $this->caching->add($this->mockProduct);

        $this->assertArrayHasKey(1,$this->caching->getContents());
    } 

    public function testRemovesFromCache()
    {
        $this->mockProduct
            ->shouldReceive('getId')
            ->times(3)
            ->andReturn(1);

        $anotherMockProduct = \Mockery::mock('\Webshop\Products\Product');  

        $anotherMockProduct
            ->shouldReceive('getId')
            ->once()
            ->andReturn(2);  

        $this->caching->add($this->mockProduct);
        $this->caching->add($anotherMockProduct);
        $this->caching->remove($this->mockProduct);

        $this->assertCount(1,$this->caching->getContents(), 'message');
        $this->assertArrayHasKey(2,$this->caching->getContents());
    } 
}