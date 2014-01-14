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

    public function testItStoreNewDeps()
    {
        $this->sl['test'] = 'works!';
        $this->assertEquals('works!', $this->sl['test']);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testItThowsExceptionIfValuesIsNotInDeps()
    {
        $this->sl['test'] = 'ok!';
        $this->sl['undefinedDeps'];
    }
}