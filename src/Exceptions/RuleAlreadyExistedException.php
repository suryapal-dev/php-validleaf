<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf\Exceptions;

use Exception;

class RuleAlreadyExistedException extends Exception
{
	/**
	 * @param 	string	$ruleName
	 * 
	 * @return void
	 */
	public function __construct(string $ruleName)
    {
        parent::__construct("Rule already existed: $ruleName. Try other names.");
    }
}
