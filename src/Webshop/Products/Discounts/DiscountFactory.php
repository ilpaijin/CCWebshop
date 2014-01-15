<?php

namespace Webshop\Products\Discounts;

use \InvalidArgumentException;

/**
* AbstractDiscount class
*
* @package default
* @author ilpaijin <ilpaijin@gmail.com>
*/
class DiscountFactory 
{
    private static $registry = array();

    public static function build($value, $discount, $duration = null)
    {
        $discountClass = __NAMESPACE__ . '\\' . ucfirst($discount) .'Discount';

        if(!class_exists($discountClass))
        {
            throw new InvalidArgumentException("Discount {$discountClass} doesn't exists");
        }

        if(!is_numeric($value))
        {
            throw new InvalidArgumentException("Discount value must be a number");
        }

        $key = $discount.$value;

        if(!isset($registry[$key]))
        {
            static::$registry[$key] = new $discountClass($value, $duration);
        }    

        return static::$registry[$key];
    }
}