<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf\Exceptions;

use Exception;

class MethodNoArgumentNeededException extends Exception
{
	/**
	 * @param 	string	$ruleName
	 * 
	 * @return void
	 */
	public function __construct(string $ruleName)
    {
        parent::__construct("No argument needed for the $ruleName rule. You can pass shouldValidate only which is also optional and by default true.");
    }
}
