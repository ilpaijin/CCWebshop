<?php

use Webshop\DI\ServiceLocator;

$sl = new ServiceLocator();

$sl['customerA'] = function()
{
    return new Webshop\Customer('customerA');
}; 

$sl['InMemoryCaching'] = function()
{
    return new Webshop\CachingLayer\RedisCaching;
}; 

$sl['db'] = ServiceLocator::share(function()
{
    return new Webshop\PersistanceLayer\SqlLitePersist;
}); 