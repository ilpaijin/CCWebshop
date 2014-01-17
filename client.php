<?php

use Webshop\CachingLayer\Cache as Cache;
use Webshop\Helpers\Faker;
use Webshop\Products\ProductSubscriptionDecorator as SubscriptionProduct;
use Webshop\Products\Product as OneoffProduct;

require_once 'vendor/autoload.php';
require_once 'config/di.php'; 

setlocale(LC_MONETARY, 'en_US.UTF-8');

/**
 * Adding Products
 */

$productA = new SubscriptionProduct(array(
    'id' => Webshop\Helpers\Faker::getRandomId(),
    'name' => 'productA',
    'qty' => 2,
    'price' => 13.50
));

$productB = new OneoffProduct(array(
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

$cart = new Webshop\Cart($sl['db'], Cache::getDriver('memory')); //$sl['memoryCaching'];

$cart->addCustomer($sl['customerA']);

// var_dump($cart);

$cart->addProduct($productA);
$cart->addProduct($productB);
// $cart->removeProduct($productA);

$total = $cart->getCachedContentsTotal();

echo "<h3> Cached Total: " . Faker::monetize($total) . "</h3>";

// var_dump($cart->getCachedContents());

$cart->purchase();

$cart->getPersistContents();