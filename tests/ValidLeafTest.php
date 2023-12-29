<?php

declare(strict_types=1);

use SuryaByte\ValidLeaf\ValidLeaf;
use SuryaByte\ValidLeaf\Exceptions\NoRulesToValidateException;
use SuryaByte\ValidLeaf\Exceptions\DuplicateRuleAppliedException;

it('without rule applied validate should throw error', function () {
    $emailCheck = ValidLeaf::validate('test@test.test');
})->throws(NoRulesToValidateException::class);

it('same rule applied multiple time for validate should throw error', function () {
    $emailCheck = ValidLeaf::isEmail()->isEmail()->validate('test@test.test');
})->throws(DuplicateRuleAppliedException::class);

it('should validate email', function () {
    $emailCheck = ValidLeaf::isEmail()->validate('test@test.test');
    expect($emailCheck)->toBeTrue();
});

it('invalidates as no value is passed', function () {
    $emailCheck = ValidLeaf::isEmail()->validate();
    expect($emailCheck)->toBeFalse();
});

it('invalidates as numeric value is passed', function () {
    $emailCheck = ValidLeaf::isEmail()->validate(10);
    expect($emailCheck)->toBeFalse();
});
