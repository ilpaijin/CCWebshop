<?php

namespace Webshop\Products\Discounts;

/**
* MonthlyDiscount class
*
* @package default
* @author ilpaijin <ilpaijin@gmail.com>
*/
class MonthlyDiscount
{
    protected $duration;

    protected $value;

    public function __construct($value, $duration)
    {
        $this->duration = new \DateTime('now '. $duration);
        $this->value = $value;
    }

    public function getDiscount($price)
    {
        return $price - (($price/100)*$this->value);
    }

    public function isExpired($date)
    {
        return $this->duration > $date;
    }
}