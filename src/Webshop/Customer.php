<?php

namespace Webshop;

/**
* Customer class
*
* @package default
* @author ilpaijin <ilpaijin@gmail.com>
*/
class Customer 
{
    /**
     * $id customer
     * @var string
     */
    protected $id;

    /**
     * new simple user
     * @param string $username default "Paolo"
     */
    public function __construct($username = 'Paolo')
    {
        $this->username = $username;
        $this->id = Helpers\Faker::getRandomId();
    }
}