<?php

namespace Webshop\Helpers;

/**
* Faker class
*
* @package default
* @author ilpaijin <ilpaijin@gmail.com>
*/
class Faker 
{
    /**
     * Returns an alphanumeric 8 chars code
     * @return string $id
     */
    public static function getRandomId($take = 8)
    {
        $letters = array('a','b','c','d','e','f','g','h');
        $numbers = array(0,1,2,3,4,5,6,7,8,9);

        $chars = $letters + $numbers;

        $id='';

        for($i=0; $i < $take; $i++)
        {
            $rand = rand(0, count($chars) - 1);

            $id .= $chars[$rand];
        }

        return $id;
    }

    /**
     * Format money
     * @param  float $value
     * @return float $value
     */
    public static function monetize($value)
    {
        if (function_exists('money_format'))
        {
            return money_format("%n", $value);
        }

        return sprintf("%0.2f", $value);
    }
}