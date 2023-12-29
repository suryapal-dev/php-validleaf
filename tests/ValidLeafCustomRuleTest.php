<?php

declare(strict_types=1);

use SuryaByte\ValidLeaf\ValidLeaf;
use SuryaByte\ValidLeaf\Exceptions\ArgumentRequiredForMethodException;
use SuryaByte\ValidLeaf\Exceptions\DuplicateRuleAppliedException;
use SuryaByte\ValidLeaf\Exceptions\SetArgumentMethodNotFoundException;
use SuryaByte\ValidLeaf\Tests\CustomRules\HaveSuffixRule;
use SuryaByte\ValidLeaf\Tests\CustomRules\TestRule;

// Register custom rules
ValidLeaf::addRule('haveSuffix', new HaveSuffixRule(), [
    'name' => 'stringToCheck',
    'is_required' => true,
    'default' => null,
    'format' => 'string',
    'description' => 'String to check again validate.'
]);

// Let's register isTest and the argument passed are not correct, in fact there is no argument
ValidLeaf::addRule('isTest', new TestRule(), [
    'name' => 'message',
    'is_required' => true,
    'default' => null,
    'format' => 'string',
    'description' => 'For message.'
]);

it('validates test@test.com email and having suffix check on .com', function () {
    $emailSuffixCheck = ValidLeaf::haveSuffix(stringToCheck: '.com')->validate('test@test.com');
    expect($emailSuffixCheck)->toBeTrue();
});

it('invalidates test@test.org email and having suffix check on .com', function () {
    $emailSuffixCheck = ValidLeaf::haveSuffix(stringToCheck: '.com')->validate('test@test.org');
    expect($emailSuffixCheck)->toBeFalse();
});

it('validates test@test.org email with isEmail rule and having suffix check on .com but suffix check is disabled', function () {
    $emailSuffixCheck = ValidLeaf::isEmail()->haveSuffix(stringToCheck: '.com', shouldValidate: false)->validate('test@test.org');
    expect($emailSuffixCheck)->toBeTrue();
});

it('invalidates test@test.org email with isEmail rule and having suffix check on .com', function () {
    $emailSuffixCheck = ValidLeaf::isEmail()->haveSuffix(stringToCheck: '.com')->validate('test@test.org');
    expect($emailSuffixCheck)->toBeFalse();
});

it('throws ArgumentRequiredForMethodException as argument is required for haveSuffix rule', function () {
    $emailSuffixCheck = ValidLeaf::haveSuffix()->validate('test@test.test');
})->throws(ArgumentRequiredForMethodException::class);

it('throws DuplicateRuleAppliedException as haveSuffix is applied two times', function () {
    $emailSuffixCheck = ValidLeaf::haveSuffix(stringToCheck: '.test')->isEmail()->haveSuffix()->validate('test@test.test');
})->throws(DuplicateRuleAppliedException::class);

it('throws SetArgumentMethodNotFoundException as isTest does not have setArguments method in the class', function () {
    $emailSuffixCheck = ValidLeaf::isTest(message: 'nothing')->validate('nothing');
})->throws(SetArgumentMethodNotFoundException::class);
