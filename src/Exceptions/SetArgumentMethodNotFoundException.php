<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf\Exceptions;

use Exception;

class SetArgumentMethodNotFoundException extends Exception
{
	/**
	 * @param 	string	$ruleName
	 * 
	 * @return void
	 */
	public function __construct(string $ruleName)
    {
        parent::__construct("$ruleName class does not contain setArgument method, if you are working with extra arguments, you can apply these method. For more context, check the documentation.");
    }
}
