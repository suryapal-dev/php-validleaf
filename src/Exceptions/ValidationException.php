<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf\Exceptions;

use Exception;

class ValidationException extends Exception
{
	private array $errors = [];

    public function __construct(string $message = "Validation Error", array $errors = [])
    {
        $this->errors = $errors;
        parent::__construct($message);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
