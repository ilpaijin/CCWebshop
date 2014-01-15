<?php

use Webshop\Helpers\Faker;
use Webshop\DI\ServiceLocator;

$sl = new ServiceLocator();

$sl['customerA'] = function()
{
    return new Webshop\Customer('customerA');
}; 

$sl['InMemoryStorage'] = function()
{
    return new Webshop\Storage\InMemoryStorage;
}; 

$sl['db'] = ServiceLocator::share(function()
{
    return new Webshop\Persistance\SqlLitePersist;
}); 