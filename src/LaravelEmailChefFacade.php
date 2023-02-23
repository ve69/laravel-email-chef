<?php

namespace OfflineAgency\LaravelEmailChef;

use Illuminate\Support\Facades\Facade;

/**
 * @see \OfflineAgency\LaravelEmailChef\LaravelEmailChef
 */
class LaravelEmailChefFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-email-chef';
    }
}
