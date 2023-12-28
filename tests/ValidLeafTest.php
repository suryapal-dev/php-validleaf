<?php

use SuryaByte\ValidLeaf\ValidLeaf;
use SuryaByte\ValidLeaf\RuleFactory;
use SuryaByte\ValidLeaf\Tests\CustomRules\IsEqualEmailToRule;

it('validates a value passed in validator is email', function () {
    $emailCheck = ValidLeaf::isEmail()->validate('test@test.com');
    expect($emailCheck)->toBeTrue();
});

it('validates a value passed in validator is email and is equal to a static checked email (custom rule)', function () {
    ValidLeaf::addRule('isEqualEmail', new IsEqualEmailToRule());
    $emailCheck = ValidLeaf::isEmail()->isEqualEmail()->validate('test@test.com');
    expect($emailCheck)->toBeTrue();
});
