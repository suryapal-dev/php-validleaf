<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf\Tests\CustomRules;

use SuryaByte\ValidLeaf\Rules\RuleAbstract;

class HaveSuffixRule extends RuleAbstract
{
    protected ?string $stringToCheck = null;

    public function setArguments(string $stringToCheck): void
    {
        $this->stringToCheck = $stringToCheck;
    }

    /**
     * @inheritdoc
     */
	public function validate(mixed $value): bool
    {
        return str_ends_with($value, $this->stringToCheck);
    }

    /**
     * @inheritdoc
     */
    public function getErrorMessage(): string
    {
        return 'The value is not equal.';
    }
}
