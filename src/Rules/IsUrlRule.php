<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf\Rules;

class IsUrlRule extends RuleAbstract
{
    protected bool $haveScheme = false;

    public function setArguments(bool $haveScheme): void
    {
        $this->haveScheme = $haveScheme;
    }

    /**
     * @inheritdoc
     */
	public function validate(mixed $value): bool
    {
        if ('string' !== $value) {
            return false;
        }
        $url = filter_var($value, FILTER_VALIDATE_URL);

        $scheme = ($this->haveScheme) ? parse_url($value, PHP_URL_SCHEME) : 'http';
        if (!$url || !$scheme || !in_array($scheme, ['http', 'https', 'ftp'], true)) {
            return false;
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function getErrorMessage(): string
    {
        return 'The value is not a valid URL.';
    }
}
