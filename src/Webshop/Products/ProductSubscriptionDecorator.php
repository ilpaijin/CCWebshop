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
    /**
     * Product type
     * @var string
     */
    protected $type = 'Montly';

    /**
     * The date of the subscription
     * @var DateTime
     */
    protected $subscribedAt;

    /**
     * Create a new instance
     * @param array $data
     */
    public function __construct( array $product )
    {
        parent::__construct($product);

        $this->subscribedAt = new \DateTime('now');
        $this->setExpiration(new \DateTime('now '.$this->getQty().' month'));
    }

    /**
     * Mutators method for adding quantity
     * @param int $num
     */
    public function addQty($num)
    {
        parent::addQty($num);

        $this->setExpiration(new \DateTime('now '.$this->getQty().' month'));
    }

    /**
     * Accessor for getting the the expiration
     * @param Datetime $date
     */
    public function setExpiration(\DateTime $date)
    {
        $this->expiration = $date;
    }
}