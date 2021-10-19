<?php

namespace App\Enums;

use ReflectionClass;

abstract class Enum
{
    private function __construct()
    {
    }

    public static function getConstants(): array
    {
        return (new ReflectionClass(static::class))->getConstants();
    }

    public static function getSelectOptions(): array
    {
        $options = array_values(self::getConstants());
        return array_combine($options, $options);
    }
}
