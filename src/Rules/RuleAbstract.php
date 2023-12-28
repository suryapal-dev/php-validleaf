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
	abstract public static function setErrorMessage(): string;

	/**
	 * @throws \SuryaByte\ValidLeaf\Exceptions\ValidationException
	 */
    public static function getError(): ValidationException
    {
        throw new ValidationException(self::setErrorMessage());
    }
}
