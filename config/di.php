<?php

use Webshop\DI\ServiceLocator;
use Webshop\CachingLayer\Cache;

$sl = new ServiceLocator();

$sl['customerA'] = function()
{
    return new Webshop\Customer('customerA');
}; 

$sl['memoryCaching'] = function()
{
    return Cache::$drivers['memory'] = new Webshop\CachingLayer\InMemoryCaching;
}; 

$sl['redisCaching'] = function()
{
    return Cache::$drivers['redis'] = new Webshop\CachingLayer\RedisCaching;
}; 

$sl['db'] = ServiceLocator::share(function()
{
    return new Webshop\PersistanceLayer\SqlLitePersist;
}); 