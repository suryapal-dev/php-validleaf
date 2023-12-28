<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf\Rules;

use SuryaByte\ValidLeaf\Rules\Interfaces\RuleInterface;

class EmailRule implements RuleInterface
{
    /**
     * @param   mixed   $value
     * 
     * @return  bool
     */
	public function validate(mixed $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * @return  string
     */
    public function getError(): string
    {
        return 'The value is not a valid email address.';
    }
}
