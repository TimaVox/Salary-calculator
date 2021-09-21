<?php


namespace App\Logic\Facades;


use Illuminate\Support\Facades\Facade;

class CalculateFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'calculate';
    }
}
