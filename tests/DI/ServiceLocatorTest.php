<?php

/**
* ServiceLocatorTest class
*
* @package default
* @author ilpaijin <ilpaijin@gmail.com>
*/
class ServiceLocatorTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->sl = new Webshop\DI\ServiceLocator;
    }

    public function tearDown()
    {
        $this->sl = null;
    }

    public function testItStoreAndRetrieveNewDeps()
    {
        $this->sl['test'] = 'works!';
        $this->assertEquals('works!', $this->sl['test']);
    }

    public function testCheckExistence()
    {
        $this->sl['test'] = 'exist';
        $this->assertTrue(isset($this->sl['test']));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testItThrowsExceptionIfValuesIsNotInDeps()
    {
        $this->sl['test'] = 'ok!';
        $this->sl['undefinedDeps'];
    }

    public function testShareSameInstance()
    {
        $this->sl['stdClass'] = Webshop\DI\ServiceLocator::share(function()
        {
            return new stdClass();
        });

        $a = $this->sl['stdClass'];
        $b = $this->sl['stdClass'];

        $this->assertTrue($a === $b);
    }

    public function testDoesntShareSameInstance()
    {
        $this->sl['stdClass'] = function()
        {
            return new stdClass();
        };

        $a = $this->sl['stdClass'];
        $b = $this->sl['stdClass'];
        
        $this->assertFalse($a === $b);
    }
}