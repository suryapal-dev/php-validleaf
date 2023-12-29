<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf\Exceptions;

use Exception;

class DuplicateRuleAppliedException extends Exception
{
	/**
	 * @param 	string	$ruleName
	 * 
	 * @return void
	 */
	public function __construct(string $ruleName)
    {
        parent::__construct("$ruleName rule already applied");
    }
}
