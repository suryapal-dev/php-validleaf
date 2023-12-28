<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf;

use SuryaByte\ValidLeaf\Rules\Interfaces\RuleInterface;
use SuryaByte\ValidLeaf\Rules\EmailRule;
use Exception;

final class Validator
{
    private ?RuleFactory $ruleFactory;
    private array $rules = [];

    public function __construct()
    {
        $this->registerPredefinedRules();
    }

    private function createRule(string $name): RuleInterface
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

    public function addRule(string $ruleName, RuleInterface $rule): void
    {
        $this->rules[$ruleName] = $rule;
    }

    public function __call($name, $argument)
    {
        $rule = $this->createRule($name);
        $this->rules[] = $rule;
        return $this;
    }

    public function validate($value)
    {
        foreach ($this->rules as $rule) {
            if (!$rule->validate($value)) {
                throw new Exception($rule->getError());
            }
        }
        return true;
    }
}
