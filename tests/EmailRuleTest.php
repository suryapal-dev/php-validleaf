<?php

declare(strict_types=1);

use SuryaByte\ValidLeaf\ValidLeaf;
use SuryaByte\ValidLeaf\Exceptions\ValidationException;
use SuryaByte\ValidLeaf\Enums\ResponseLevel;

it('validates a value passed in validator return true', function ($email) {
    $emailCheck = ValidLeaf::isEmail()->validate($email);
    expect($emailCheck)->toBeTrue();
})->with('valid_emails');

it('invalidates a value passed in validator throws multiple ValidationException', function () {
    ValidLeaf::setResponseLevel(ResponseLevel::THROW_ALL_ERRORS); // Also this will set the response level for global
    $emailCheck = ValidLeaf::isEmail()->validate('test@test');
})->throws(ValidationException::class);

it('invalidates a value passed in validator throws ValidationException', function () {
    $emailCheck = ValidLeaf::setTemporaryResponseLevel(ResponseLevel::THROW_ERROR_ON_FIRST_FALSE)->isEmail()->validate('test@test'); // This is temp change to response level
})->throws(ValidationException::class);

it('invalidates a value passed in validator throws mulitple ValidationException again', function () {
    $emailCheck = ValidLeaf::isEmail()->validate('test@test'); // This will throw multiple validation error
})->throws(ValidationException::class);

it('invalidates a value passed in validator return false', function ($email) {
    ValidLeaf::setResponseLevel(ResponseLevel::ONLY_BOOLEAN); // Set to default
    $emailCheck = ValidLeaf::isEmail()->validate($email);
    expect($emailCheck)->toBeFalse();
})->with('invalid_emails');
