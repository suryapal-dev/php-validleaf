<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf\Rules;

use SuryaByte\ValidLeaf\Exceptions\ValidationException;

abstract class RuleAbstract
{
	/**
	 * @param 	mixed	$value
	 * 
	 * @return	bool
	 */
	abstract public function validate(mixed $value): bool;

	/**
	 * @return	string
	 */
	abstract public function getErrorMessage(): string;

	/**
	 * @throws \SuryaByte\ValidLeaf\Exceptions\ValidationException
	 */
    public function getError(): ValidationException
    {
        throw new ValidationException($this->getErrorMessage());
    }
}
