<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf\Exceptions;

use Exception;

class UndefinedLevelPassedException extends Exception
{
	/**
	 * @param 	string	$level
	 * 
	 * @return void
	 */
	public function __construct(string $level)
    {
        parent::__construct("$level is not defined response level.");
    }
}
