<?php

namespace App\Actions;

abstract class BaseAction
{
    public abstract function call(): bool;

    public static function make(): BaseAction
    {
        $class = get_called_class();

        return new $class(...func_get_args());
    }
}
