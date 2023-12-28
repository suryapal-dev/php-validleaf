<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf\Rules;

use SuryaByte\ValidLeaf\Rules\Interfaces\RuleInterface;
use SuryaByte\ValidLeaf\Exceptions\ValidationException;

class EmailRule implements RuleInterface
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
    public function getError(): ValidationException
    {
        throw new ValidationException('The value is not a valid email address.');
    }
}
