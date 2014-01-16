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
     * Create new monthlyDiscount instance
     * @param int $value 
     * @param DateTime $duration
     */
    public function __construct($value, $duration)
    {
        $this->duration = new \DateTime('now '. $duration);
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

    /**
     * Check if current discount is expired
     * @param  DateTime  $date 
     * @return boolean 
     */
    public function isExpired($date)
    {
        return $this->duration > $date;
    }
}