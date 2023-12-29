<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf\Enums;

enum ResponseLevel: string
{
    case ONLY_BOOLEAN = 'only_boolean';

    case THROW_ERROR_ON_FIRST_FALSE = 'throw_error_on_first_false';

    case THROW_ALL_ERRORS = 'throw_all_errors';
}