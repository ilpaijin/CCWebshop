<?php

namespace Webshop\Products;

/**
* ProductSubscriptionDecorator class
*
* @package default
* @author ilpaijin <ilpaijin@gmail.com>
*/
class ProductSubscriptionDecorator extends Product implements ProductInterface
{
    private $product;

    protected $type = 'Montly';

    public function __construct($data)
    {
        parent::__construct($data);
        $this->setExpiration(new \DateTime('now next month'));
    }

    public function setExpiration(\DateTime $date)
    {
        $this->expiration = $date;
    }
}