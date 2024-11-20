<?php

namespace Cruz\CustomLaravelQueues\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Cruz\CustomLaravelQueues\CustomLaravelQueues
 */
class CustomLaravelQueues extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Cruz\CustomLaravelQueues\CustomLaravelQueues::class;
    }
}
