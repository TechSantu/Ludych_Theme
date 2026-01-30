<?php

/**
 * Custom rule to validate a PHPDoc docblock that precedes a hook.
 */

declare(strict_types=1);

namespace SzepeViktor\PHPStan\WordPress;

use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Name;
use PHPStan\Analyser\Scope;
use PHPStan\PhpDoc\ResolvedPhpDocBlock;
use PHPStan\PhpDoc\Tag\ParamTag;
use PHPStan\Rules\RuleErrorBuilder;
use PHPStan\Rules\RuleLevelHelper;
use PHPStan\Type\FileTypeMapper;
use PHPStan\Type\VerbosityLevel;

/**
 * @implements \PHPStan\Rules\Rule<\PhpParser\Node\Expr\FuncCall>
 */
class HookDocsRule implements \PHPStan\Rules\Rule
{
    private const SUPPORTED_FUNCTIONS = [
        'apply_filters',
        'do_action',
    ];

    /** @var \SzepeViktor\PHPStan\WordPress\HookDocBlock */
    protected $hookDocBlock;

    /** @var \PHPStan\Rules\RuleLevelHelper */
    protected $ruleLevelHelper;

    /** @var \PhpParser\Node\Expr\FuncCall */
    protected $currentNode;

    /** @var \PHPStan\Analyser\Scope */
    protected $currentScope;

    /** @var list<\PHPStan\Rules\IdentifierRuleError> */
    private $errors;

    public function __construct(
        FileTypeMapper $fileTypeMapper,
        RuleLevelHelper $ruleLevelHelper
    ) {
        $this->hookDocBlock = new HookDocBlock($fileTypeMapper);
        $this->ruleLevelHelper = $ruleLevelHelper;
    }

    public function getNodeType(): string
    {
        return FuncCall::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        $this->currentNode = $node;
        $this->currentScope = $scope;
        $this->errors = [];

        if (! ($node->name instanceof Name)) {
            return [];
        }

        if (! in_array($node->name->toString(), self::SUPPORTED_FUNCTIONS, true)) {
            return [];
        }

        $resolvedPhpDoc = $this->hookDocBlock->getNullableHookDocBlock($node, $scope);

        if ($resolvedPhpDoc === null) {
            return [];
        }

        $this->validateDocBlock($resolvedPhpDoc);

        return $this->errors;
    }

    /**
     * Validates the `@param` tags documented in the given docblock.
     */
    public function validateDocBlock(ResolvedPhpDocBlock $resolvedPhpDoc): void
    {
        $numberOfParamTagStrings = substr_count($resolvedPhpDoc->getPhpDocString(), '* @param ');

        if ($numberOfParamTagStrings === 0) {
            return;
        }

        $this->validateParamCount($numberOfParamTagStrings);

        if ($this->errors !== []) {
            return;
        }

        $paramTags = $resolvedPhpDoc->getParamTags();

        $this->validateParamDocumentation(count($paramTags), $resolvedPhpDoc);
        if ($this->errors !== []) {
            return;
        }

        $nodeArgs = $this->currentNode->getArgs();
        $paramIndex = 1;

        foreach ($paramTags as $paramName => $paramTag) {
            $this->validateSingleParamTag($paramName, $paramTag, $nodeArgs[$paramIndex]);
            $paramIndex += 1;
        }
    }

    /**
     * Validates the number of documented `@param` tags in the docblock.
     */
    public function validateParamCount(int $numberOfParamTagStrings): void
    {
        $numberOfParams = count($this->currentNode->getArgs()) - 1;

        if ($numberOfParams === $numberOfParamTagStrings) {
            return;
        }

        $this->errors[] = RuleErrorBuilder::message(
            sprintf(
                'Expected %1$d @param tags, found %2$d.',
                $numberOfParams,
                $numberOfParamTagStrings
            )
        )->identifier('paramTag.count')->build();
    }

    /**
     * Validates the number of parsed and valid `@param` tags in the docblock.
     */
    public function validateParamDocumentation(
        int $numberOfParamTags,
        ResolvedPhpDocBlock $resolvedPhpDoc
    ): void {
        $nodeArgs = $this->currentNode->getArgs();
        $numberOfParams = count($nodeArgs) - 1;

        if ($numberOfParams === $numberOfParamTags) {
            return;
        }

        $namedThis = false;
        if (strpos($resolvedPhpDoc->getPhpDocString(), ' $this') !== false) {
            foreach ($nodeArgs as $param) {
                if (($param->value instanceof Variable) && $param->value->name === 'this') {
                    $namedThis = true;
                    break;
                }
            }
        }

        $this->errors[] = RuleErrorBuilder::message(
            $namedThis === true
                ? '@param tag must not be named $this. Choose a descriptive alias, for example $instance.'
                : 'One or more @param tags has an invalid name or invalid syntax.'
        )->identifier('phpDoc.parseError')->build();
    }

    /**
     * Validates a `@param` tag against its actual parameter.
     *
     * @param string                       $paramName The param tag name.
     * @param \PHPStan\PhpDoc\Tag\ParamTag $paramTag  The param tag instance.
     * @param \PhpParser\Node\Arg          $arg       The actual parameter instance.
     */
    protected function validateSingleParamTag(string $paramName, ParamTag $paramTag, Arg $arg): void
    {
        $paramTagType = $paramTag->getType();
        $paramType = $this->currentScope->getType($arg->value);
        $accepted = $this->ruleLevelHelper->accepts(
            $paramTagType,
            $paramType,
            $this->currentScope->isDeclareStrictTypes()
        );

        if ($accepted) {
            return;
        }

        $paramTagVerbosityLevel = VerbosityLevel::getRecommendedLevelByType($paramTagType);
        $paramVerbosityLevel = VerbosityLevel::getRecommendedLevelByType($paramType);

        $this->errors[] = RuleErrorBuilder::message(
            sprintf(
                '@param %1$s $%2$s does not accept actual type of parameter: %3$s.',
                $paramTagType->describe($paramTagVerbosityLevel),
                $paramName,
                $paramType->describe($paramVerbosityLevel)
            )
        )->identifier('parameter.phpDocType')->build();
    }
}
