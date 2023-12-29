<?php

declare(strict_types=1);

use SuryaByte\ValidLeaf\ValidLeaf;
use SuryaByte\ValidLeaf\Exceptions\NoRulesToValidateException;
use SuryaByte\ValidLeaf\Enums\ResponseLevel;

it('without rule applied validate should throw error', function () {
    $emailCheck = ValidLeaf::validate('test@test.test');
})->throws(NoRulesToValidateException::class);

it('same rule applied multiple time for validate should throw error', function () {
    $emailCheck = ValidLeaf::validate('test@test.test');
})->throws(NoRulesToValidateException::class);
