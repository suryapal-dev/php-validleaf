<?php

namespace SuryaByte\ValidLeaf\Tests\CustomRules;

use SuryaByte\ValidLeaf\Rules\Interfaces\RuleInterface;

class IsEqualEmailToRule implements RuleInterface
{
	public function validate($valueToCheck): bool
    {
        return 'test@test.com' === $valueToCheck;
    }

    public function getError(): string
    {
        return 'The value is not a equal.';
    }
}