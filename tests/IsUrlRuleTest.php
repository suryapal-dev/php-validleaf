<?php

declare(strict_types=1);

use SuryaByte\ValidLeaf\ValidLeaf;
use SuryaByte\ValidLeaf\Exceptions\ValidationException;
use SuryaByte\ValidLeaf\Enums\ResponseLevel;

it('validates values passed are URL', function ($url) {
    $urlCheck = ValidLeaf::isURL()->validate($url);
    expect($urlCheck)->toBeTrue();
})->with('valid_urls');
