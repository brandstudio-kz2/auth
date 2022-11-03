<?php

namespace BrandStudio\Auth\Facades;

use Illuminate\Support\Facades\Facade;

class BsAuth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'brandstudio_auth';
    }

}
