<?php

require_once 'vendor/autoload.php';
require_once 'config/di.php'; 

$cart = new Webshop\Cart($sl);

$productA = new Webshop\Products\ProductSubscriptionDecorator(array(
    'id' => Webshop\Helpers\Faker::getRandomId(),
    'name' => 'productA',
    'qty' => 2,
    'price' => 13.50
));

$productA->addQty(8);

$productA->setDiscount(20);

$productB = new Webshop\Products\Product(array(
    'id' => Webshop\Helpers\Faker::getRandomId(),
    'name' => 'productB',
    'qty' => 1,
    'price' => 55.50
));

$cart->addProduct($productA);
$cart->addProduct($productB);
// $cart->removeProduct($productA);

$cart->getStorageTotal();

var_dump($cart->getStorageContents());

$cart->purchase();

$cart->getPersistContents();
