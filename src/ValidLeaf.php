<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf;

use Exception;

final class ValidLeaf
{
    /**
     * @var ?\SuryaByte\ValidLeaf\Validator
     */
    private static $validator;

    /**
     * @param   string  $name
     * @param   array   $arguments
     * 
     * @return  \SuryaByte\ValidLeaf\Validator
     */
    public static function __callStatic(string $name, array $arguments): ?Validator
    {
        if (!self::$validator) {
            self::$validator = new Validator();
            self::$validator->registerPredefinedRules();
        }
        return self::$validator->{$name}(...$arguments);
    }
}
