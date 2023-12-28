<?php

declare(strict_types=1);

dataset('invalid_emails', [
	'##()()()($#$@test.test',
	'test-*&(**())--.-.---123@test.com',
	str_repeat('a', 200) . '@test.test',
]);
