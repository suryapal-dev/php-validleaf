<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf\Exceptions;

use Exception;

class ArgumentRequiredForMethodException extends Exception
{
	/**
	 * @param 	string	$argument
	 * @param 	string	$ruleName
	 * 
	 * @return void
	 */
	public function __construct(string $argument, string $ruleName)
    {
        parent::__construct("Argument $argument is required for $ruleName");
    }
}
