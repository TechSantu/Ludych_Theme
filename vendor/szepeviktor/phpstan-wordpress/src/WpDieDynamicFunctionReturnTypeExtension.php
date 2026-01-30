<?php

/**
 * Set return type of wp_die().
 */

declare(strict_types=1);

namespace SzepeViktor\PHPStan\WordPress;

use PhpParser\Node\Expr\FuncCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\FunctionReflection;
use PHPStan\Type\Constant\ConstantStringType;
use PHPStan\Type\NonAcceptingNeverType;
use PHPStan\Type\Type;
use PHPStan\Type\VoidType;

class WpDieDynamicFunctionReturnTypeExtension implements \PHPStan\Type\DynamicFunctionReturnTypeExtension
{
    public function isFunctionSupported(FunctionReflection $functionReflection): bool
    {
        return $functionReflection->getName() === 'wp_die';
    }

    /**
     * @see https://developer.wordpress.org/reference/functions/wp_die/
     *
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter.UnusedParameter
     */
    public function getTypeFromFunctionCall(FunctionReflection $functionReflection, FuncCall $functionCall, Scope $scope): Type
    {
        $args = $functionCall->getArgs();

        if (count($args) < 3) {
            return new NonAcceptingNeverType();
        }

        $argType = $scope->getType($args[2]->value);

        if (! $argType->isConstantArray()->yes()) {
            return new VoidType();
        }

        if (! $argType->hasOffsetValueType(new ConstantStringType('exit'))->yes()) {
            return new NonAcceptingNeverType();
        }

        return $argType->getOffsetValueType(new ConstantStringType('exit'))->toBoolean()->isTrue()->yes()
            ? new NonAcceptingNeverType()
            : new VoidType();
    }
}
