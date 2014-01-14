<?php

use Webshop\Helpers\Faker;
use Webshop\DI\ServiceLocator;

$sl = new ServiceLocator();

$sl['randomId'] = function()
{
    return Faker::getRandomId();
}; 