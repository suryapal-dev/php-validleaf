<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf;

use Exception;

final class ValidLeaf
{
    private static $validator;
    private static $ruleFactory;

    public static function __callStatic($name, $arguments)
    {
        if (!self::$ruleFactory) {
            self::$ruleFactory = new RuleFactory();
        }
        if ($name === 'addRule') {
            self::$ruleFactory->addRule(...$arguments);
            return;
        }
        if (!self::$validator) {
            self::$validator = new Validator(self::$ruleFactory);
        }
        return self::$validator->{$name}(...$arguments);
    }
}
