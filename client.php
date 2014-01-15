<?php

require_once 'vendor/autoload.php';
require_once 'config/di.php'; 

/**
 * Adding Products
 */

$productA = new Webshop\Products\ProductSubscriptionDecorator(array(
    'id' => Webshop\Helpers\Faker::getRandomId(),
    'name' => 'productA',
    'qty' => 2,
    'price' => 13.50
));

$productB = new Webshop\Products\Product(array(
    'id' => Webshop\Helpers\Faker::getRandomId(),
    'name' => 'productB',
    'qty' => 1,
    'price' => 55.50
));

/**
 * Adding Qty and appying Discounts
 */

$productA->addQty(8);

$productA->addDiscount(20, 'monthly', '1 month');

$productB->addDiscount(5, 'oneoff', '1 hour');


/**
 * Cart 
 */

$cart = new Webshop\Cart($sl);

$cart->addProduct($productA);
$cart->addProduct($productB);
// $cart->removeProduct($productA);

$cart->getCachedContentsTotal();

// var_dump($cart->getCachingLayerContents());

$cart->purchase();

$cart->getPersistContents();
