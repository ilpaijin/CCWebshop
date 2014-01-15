<?php

use Webshop\DI\ServiceLocator;

$sl = new ServiceLocator();

$sl['customerA'] = function()
{
    return new Webshop\Customer('customerA');
}; 

$sl['InMemoryCachingLayer'] = function()
{
    return new Webshop\CachingLayer\InMemoryCaching;
}; 

$sl['db'] = ServiceLocator::share(function()
{
    return new Webshop\PersistanceLayer\SqlLitePersist;
}); 