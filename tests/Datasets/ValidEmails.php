<?php

declare(strict_types=1);

dataset('valid_emails', [
	'test@test.test',
	'test-123@test.com',
	str_repeat('a', 5) . '@test.test',
]);
