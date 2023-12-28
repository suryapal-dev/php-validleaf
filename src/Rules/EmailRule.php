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
        return false !== filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @inheritdoc
     */
    public function getErrorMessage(): string
    {
        return 'The value is not a valid email address.';
    }
}
