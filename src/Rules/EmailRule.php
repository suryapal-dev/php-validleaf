<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf\Rules;

class EmailRule extends RuleAbstract
{
    /**
     * @inheritdoc
     */
	public function validate(mixed $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * @inheritdoc
     */
    public static function setErrorMessage(): string
    {
        return 'The value is not a valid email address.';
    }
}
