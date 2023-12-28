<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf\Rules\Interfaces;

interface RuleInterface
{
	/**
	 * @param 	mixed	$value
	 * 
	 * @return	bool
	 */
	public function validate(mixed $value): bool;

	/**
	 * @return	string
	 */
    public function getError(): string;
}
