<?php

namespace Marcha\Image2\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Marcha\Image2\Image2
 */
class Image2 extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Marcha\Image2\Image2::class;
    }
}
