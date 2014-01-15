<?php

namespace Webshop\Products\Discounts;

/**
* OneoffDiscount class
*
* @package default
* @author ilpaijin <ilpaijin@gmail.com>
*/
class OneoffDiscount
{
    protected $duration;

    protected $value;

    public function __construct($value, $duration)
    {
        $this->duration = new \DateTime($duration);;
        $this->value = $value;
    }

    public function getDiscount($price)
    {
        return $price - (($price/100)*$this->value);
    }
}
