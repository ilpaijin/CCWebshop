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
    /**
     * Duration of the discount 
     * @var Datetime
     */
    protected $duration;

    /**
     * Value of the discount
     * @var int
     */
    protected $value;

    /**
     * Create new oneoff instance
     * @param int $value 
     * @param DateTime $duration
     */
    public function __construct($value, $duration)
    {
        $this->duration = new \DateTime($duration);;
        $this->value = $value;
    }

    /**
     * Apply discount to the passed price
     * @param  float $price 
     * @return float $price 
     */
    public function getDiscount($price)
    {
        return $price - (($price/100)*$this->value);
    }
}
