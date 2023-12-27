<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf\Rules\Interfaces;

interface RuleInterface
{
	public function validate(string|array|null|int|float $value): bool;
    public function getError(): string;
}
