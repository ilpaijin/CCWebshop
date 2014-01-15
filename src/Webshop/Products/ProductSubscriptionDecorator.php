<?php

namespace Webshop\Products;

/**
* ProductSubscriptionDecorator class
*
* @package default
* @author ilpaijin <ilpaijin@gmail.com>
*/
class ProductSubscriptionDecorator extends Product
{
    private $product;

    protected $type = 'Montly';

    protected $subscribedAt;

    public function __construct($data)
    {
        parent::__construct($data);

        $this->subscribedAt = new \DateTime('now');
        $this->setExpiration(new \DateTime('now '.$this->getQty().' month'));
    }

    public function addQty($num)
    {
        parent::addQty($num);

        $this->setExpiration(new \DateTime('now '.$this->getQty().' month'));
    }

    public function setExpiration(\DateTime $date)
    {
        $this->expiration = $date;
    }
}