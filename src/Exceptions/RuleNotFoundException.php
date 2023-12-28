<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf\Exceptions;

use Exception;

class RuleNotFoundException extends Exception
{
	/**
	 * @param 	string	$ruleName
	 * 
	 * @return void
	 */
	public function __construct(string $ruleName)
    {
        parent::__construct("Rule not found: $ruleName");
    }
}
