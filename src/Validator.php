<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf;

use Exception;

final class Validator
{
    private ?RuleFactory $ruleFactory;
    private array $rules = [];

    public function __construct(RuleFactory $ruleFactory)
    {
        $this->ruleFactory = $ruleFactory;
    }

    public function __call($name, $argument)
    {
        $rule = $this->ruleFactory->createRule($name);
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
