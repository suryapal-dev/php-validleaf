<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf;

use SuryaByte\ValidLeaf\Rules\Interfaces\RuleInterface;
use SuryaByte\ValidLeaf\Rules\EmailRule;
use Exception;

final class RuleFactory
{
    private array $rules = [];

    public function __construct()
    {
        $this->registerPredefinedRules();
    }

    public function addRule(string $ruleName, RuleInterface $rule): void
    {
        $this->rules[$ruleName] = $rule;
    }

    public function createRule(string $name): RuleInterface
    {
        if (!isset($this->rules[$name])) {
            throw new Exception("Invalid rule: $name");
        }
        return $this->rules[$name];
    }

    private function registerPredefinedRules(): void
    {
        $this->addRule('isEmail', new EmailRule());
    }
}