<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf\Exceptions;

use Exception;

class MultipleValidationException extends Exception
{
	private array $errors = [];

    public function __construct(array $errors)
    {
        $this->errors = $errors;
        parent::__construct("Validation failed!");
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
