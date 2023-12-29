<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf\Tests\CustomRules;

use SuryaByte\ValidLeaf\Rules\RuleAbstract;

class TestRule extends RuleAbstract
{
    protected ?string $message = null;

    /**
     * @inheritdoc
     */
	public function validate(mixed $value): bool
    {
        return $this->message === $value;
    }

    /**
     * @inheritdoc
     */
    public function getErrorMessage(): string
    {
        return 'Nothing.';
    }
}
