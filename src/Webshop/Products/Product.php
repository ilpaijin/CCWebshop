<?php

namespace Webshop\Products;

/**
* Product class
*
* @package default
* @author ilpaijin <ilpaijin@gmail.com>
*/
class Product implements ProductInterface
{
    protected $id;

    protected $name;

    protected $qty;

    protected $price;

    protected $listPrice;

    protected $type = 'Oneoff';

    protected $expiration = null;

    public function __construct(array $product = array())
    {
        foreach($product as $k => $p)
        {
            $this->{$k} = $p;
        }

        $this->listPrice = $this->price;
    }

    public function addQty($num)
    {
        if(!is_numeric($num))
        {
            throw new InvalidArgumentException('Argument must be a number');
        }

        $this->qty += $num;
    }

    public function setDiscount($value)
    {
        if(!is_numeric($value))
        {
            return false;
        }
        
        $this->price = $this->price - (($this->price/100)*$value);
    }

    public function getId()
    {   
        return $this->id;
    }

    public function getName()
    {   
        return $this->name;
    }

    public function getQty()
    {   
        return $this->qty;
    }

    public function getPrice()
    {   
        return $this->price;
    }

    public function getListPrice()
    {   
        return $this->listPrice;
    }

    public function getType()
    {   
        return $this->type;
    }

    public function getExpiration()
    {   
        return $this->expiration;
    }
}