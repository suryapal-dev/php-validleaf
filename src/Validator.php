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
    private array $rulesToValidate = [];

    private function getSavedRule(string $name): array
    {
        if (!isset($this->rules[$name])) {
            throw new Exception("Invalid rule: $name");
        }
        return $this->rules[$name];
    }

    public function addRule(string $ruleName, RuleInterface $ruleClass, array $arguments = []): void
    {
        if ($this->rules[$ruleName] ?? null) {
            throw new Exception("Already existed rule: $ruleName");
        }
        $this->rules[$ruleName] = [
            'class' => $ruleClass,
            'arguments' => $arguments,
        ];
    }

    private function arrangeRuleArguments(string $methodName, array $methodArguments, array $passedArguments): array
    {
        if (count($methodArguments) == 0) {
            throw new Exception("No arguments needed for $methodName");
        }

        $arrangedArguments = [];
        /**
         * keys of methodArgument ['name', 'is_required', 'default', 'format', 'description']
         */
        foreach ($methodArguments as $methodArgument) {
            if (isset($passedArguments[$methodArguments['name']])) {
                $value = $passedArguments[$methodArguments['name']];
            } else {
                if ($methodArguments['is_required']) {
                    throw new Exception("Argument {$methodArguments['name']} is required for $methodName");
                }
                $value = $methodArguments['default'] ?? null;
            }
            $arrangedArguments[$methodArguments['name']] = $value;
        }

        return $arrangedArguments;
    }

    public function __call($name, $arguments): self
    {
        $shouldValidate = true;
        $mainArguments = [];
        if (!is_null($arguments['shouldValidate'] ?? null)) {
            if ('boolean' !== gettype($arguments['shouldValidate'])) {
                throw new Exception("Argument shouldValidate passed in $name should be boolean.");
            }
            $shouldValidate = $arguments['shouldValidate'];
            unset($arguments['shouldValidate']);
        }
        if (true === $shouldValidate) {
            $rule = $this->getSavedRule($name);
            $ruleClass = $rule['class'];
            if ($arguments) {
                $arguments = $this->arrangeRuleArguments($name, $rule['arguments'], $arguments);
                if (!method_exists($ruleClass, 'setArguments')) {
                    throw new Exception("$name class does not contain setArgument method, if you are working with extra arguments, you can apply these method. For more context, check the documentation.");
                }
                $ruleClass->setArguments(...$arguments);
            }
            $this->rulesToValidate[] = $ruleClass;
        }
        return $this;
    }

    public function validate($value): bool
    {
        foreach ($this->rulesToValidate as $rule) {
            if (!$rule->validate($value)) {
                throw new Exception($rule->getError());
            }
        }
        return true;
    }

    public function registerPredefinedRules(): void
    {
        $this->addRule('isEmail', new EmailRule());
    }
}
