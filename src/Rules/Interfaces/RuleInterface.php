<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf\Rules\Interfaces;

use SuryaByte\ValidLeaf\Exceptions\ValidationException;

interface RuleInterface
{
	/**
	 * @param 	mixed	$value
	 * 
	 * @return	bool
	 */
	public function validate(mixed $value): bool;

	/**
	 * @throws \SuryaByte\ValidLeaf\Exceptions\ValidationException
	 */
    public function getError(): ValidationException;
}
