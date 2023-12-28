<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf\Rules;

use SuryaByte\ValidLeaf\Rules\Interfaces\RuleInterface;

class EmailRule implements RuleInterface
{
	public function validate($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function getError(): string
    {
        return 'The value is not a valid email address.';
    }
}
