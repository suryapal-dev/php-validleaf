<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf\Exceptions;

use Exception;

class NoRulesToValidateException extends Exception
{
	/**
	 * @return void
	 */
	public function __construct()
    {
        parent::__construct("No rules found to validate.");
    }
}
