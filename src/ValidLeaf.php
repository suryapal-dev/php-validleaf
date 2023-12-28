<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf;

use Exception;

final class ValidLeaf
{
    private static $validator;

    public static function __callStatic($name, $arguments)
    {
        if (!self::$validator) {
            self::$validator = new Validator();
        }
        return self::$validator->{$name}(...$arguments);
    }
}
