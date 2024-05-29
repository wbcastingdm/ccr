<?php

namespace Webcasting\Club\Facade;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Http;

class ClubFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'club';
    }
}
