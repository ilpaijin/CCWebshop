<?php

namespace Webshop\Products;

use \InvalidArgumentException;

/**
* Product class
*
* @package default
* @author ilpaijin <ilpaijin@gmail.com>
*/
class Product
{
    /**
     * Product id
     * @var string
     */
    protected $id;

    /**
     * Product name 
     * @var string
     */
    protected $name;

    /**
     * Product Qauntity
     * @var int
     */
    protected $qty;

    /**
     * Product Sell price
     * @var float
     */
    protected $price;

    /**
     * Product list price
     * @var float
     */
    protected $listPrice;

    /**
     * Discount Instances
     * @var array
     */
    protected $discounts = array();

    /**
     * Product type
     * @var string
     */
    protected $type = 'Oneoff';

    /**
     * Product expiration 
     * @var [type]
     */
    protected $expiration = null;

    /**
     * Create new Product instance
     * @param array $product
     */
    public function __construct(array $product = array())
    {
        foreach($product as $k => $p)
        {
            $this->{$k} = $p;
        }

        $this->listPrice = $this->price;
    }

    /**
     * Mutators method for setting quantity
     * @param int $num
     */
    public function addQty($num)
    {
        if(!is_numeric($num))
        {
            throw new InvalidArgumentException('Argument must be a number');
        }

        $this->qty += $num;
    }

    /**
     * Add Discount instances to discounts array
     * @param int $value
     * @param string $discount
     * @param DateTime $duration
     */
    public function addDiscount($value, $discount, $duration = null)
    {
        $this->discounts[] = $d = Discounts\DiscountFactory::build($value, $discount, $duration);

        if($this->expiration && !$d->isExpired($this->expiration))
        {
            $this->price = $d->getDiscount($this->price);
        }
    }

    /**
     * Accessor for getting  theid 
     * @return int $id
     */
    public function getId()
    {   
        return $this->id;
    }

    /**
     * Accessor for getting the name
     * @return string $name
     */
    public function getName()
    {   
        return $this->name;
    }

    /**
     * Accessor for getting quantity
     * @return int $qty
     */
    public function getQty()
    {   
        return $this->qty;
    }

    /**
     * Accessor for getting the sell price
     * @return float $price
     */
    public function getPrice()
    {   
        return $this->price;
    }

    /**
     * Accessor for getting the list price
     * @return float $listPrice
     */
    public function getListPrice()
    {   
        return $this->listPrice;
    }

    /**
     * Accessor for getting the type
     * @return string $type
     */
    public function getType()
    {   
        return $this->type;
    }

    /**
     * Accessor for getting the the expiration
     * @return Datetime $expiration
     */
    public function getExpiration()
    {   
        return $this->expiration;
    }
}