<?php

use SuryaByte\ValidLeaf\ValidLeaf;
use SuryaByte\ValidLeaf\RuleFactory;

it('validates a value passed in validator is email', function () {
    $emailCheck = ValidLeaf::isEmail()->validate('test@test.com');
    expect($emailCheck)->toBeTrue();
});
