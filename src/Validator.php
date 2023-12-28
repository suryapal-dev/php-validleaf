<?php

declare(strict_types=1);

namespace SuryaByte\ValidLeaf;

use SuryaByte\ValidLeaf\Rules\Interfaces\RuleInterface;
use SuryaByte\ValidLeaf\Rules\EmailRule;
use SuryaByte\ValidLeaf\Exceptions\RuleNotFoundException;
use SuryaByte\ValidLeaf\Exceptions\RuleAlreadyExistedException;
use SuryaByte\ValidLeaf\Exceptions\MethodNoArgumentNeededException;
use SuryaByte\ValidLeaf\Exceptions\ArgumentRequiredForMethodException;
use SuryaByte\ValidLeaf\Exceptions\ShouldValidateArgumentTypeException;
use SuryaByte\ValidLeaf\Exceptions\SetArgumentMethodNotFoundException;
use SuryaByte\ValidLeaf\Exceptions\ValidationException;
use Exception;

final class Validator
{
    /**
     * @var array
     */
    private array $rules = [];

    /**
     * @var array
     */
    private array $rulesToValidate = [];

    /**
     * @param   string  $name
     * 
     * @return  array
     * @throws  \Exception
     */
    private function getSavedRule(string $name): array
    {
        if (!isset($this->rules[$name])) {
            throw new RuleNotFoundException($name);
        }
        return $this->rules[$name];
    }

    /**
     * @param   string                                              $ruleName
     * @param   \SuryaByte\ValidLeaf\Rules\Interfaces\RuleInterface $ruleClass
     * @param   array                                               $arguments
     * 
     * @return  void
     * @throws  \Exception
     */
    public function addRule(string $ruleName, RuleInterface $ruleClass, array $arguments = []): void
    {
        if ($this->rules[$ruleName] ?? null) {
            throw new RuleAlreadyExistedException($ruleName);
        }
        $this->rules[$ruleName] = [
            'class' => $ruleClass,
            'arguments' => $arguments,
        ];
    }

    /**
     * @param   string  $methodName
     * @param   array   $methodArguments
     * @param   array   $passedArguments
     * 
     * @return  array
     * @throws  \Exception
     */
    private function arrangeRuleArguments(string $methodName, array $methodArguments, array $passedArguments): array
    {
        if (count($methodArguments) == 0) {
            throw new MethodNoArgumentNeededException("No arguments needed for $methodName");
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
                    throw new ArgumentRequiredForMethodException($methodArguments['name'], $methodName);
                }
                $value = $methodArguments['default'] ?? null;
            }
            $arrangedArguments[$methodArguments['name']] = $value;
        }

        return $arrangedArguments;
    }

    /**
     * @param   string  $name
     * @param   array   $arguments
     * 
     * @return  self
     * @throws  \Exception
     */
    public function __call(string $name, array $arguments): self
    {
        $shouldValidate = true;
        $mainArguments = [];
        if (!is_null($arguments['shouldValidate'] ?? null)) {
            if ('boolean' !== gettype($arguments['shouldValidate'])) {
                throw new ShouldValidateArgumentTypeException("Argument shouldValidate passed in $name should be boolean.");
            }
            $shouldValidate = $arguments['shouldValidate'];
            unset($arguments['shouldValidate']);
        }
        if (true === $shouldValidate) {
            $rule = $this->getSavedRule($name);
            /**
             * @var \SuryaByte\ValidLeaf\Rules\Interfaces\RuleInterface
             */  
            $ruleClass = $rule['class'];
            if (count($arguments)) {
                $arguments = $this->arrangeRuleArguments($name, $rule['arguments'], $arguments);
                if (!method_exists($ruleClass, 'setArguments')) {
                    throw new SetArgumentMethodNotFoundException($name);
                }
                $ruleClass->setArguments(...$arguments);
            }
            $this->rulesToValidate[] = $ruleClass;
        }
        return $this;
    }

    /**
     * @param   mixed   $value
     * 
     * @return  bool
     * @throws  \Exception
     */
    public function validate(mixed $value): bool
    {
        foreach ($this->rulesToValidate as $rule) {
            if (!$rule->validate($value)) {
                return $rule->getError();
            }
        }
        return true;
    }

    /**
     * @return  void
     */
    public function registerPredefinedRules(): void
    {
        $this->addRule('isEmail', new EmailRule());
    }
}
