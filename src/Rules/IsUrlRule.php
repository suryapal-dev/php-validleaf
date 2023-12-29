<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf\Rules;

class IsUrlRule extends RuleAbstract
{
    /**
     * @inheritdoc
     */
	public function validate(mixed $value): bool
    {
        $url = filter_var($value, FILTER_VALIDATE_URL);

        $scheme = parse_url($value, PHP_URL_SCHEME);
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
