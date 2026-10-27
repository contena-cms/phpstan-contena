<?php

declare(strict_types=1);

namespace Contena\PhpStan\Rule\FutureCompatibility;

use PhpParser\Node\Name;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\IdentifierRuleError;
use PHPStan\Rules\RuleErrorBuilder;
use Contena\Core\Framework\Deprecation\ClassAliasRegistry;

/**
 * @internal
 */
final class ClassMovedUsage
{
    /**
     * @var array<lowercase-string, class-string>
     */
    private readonly array $aliases;

    /**
     * @param array<non-empty-string, class-string>|null $aliases
     */
    public function __construct(?array $aliases = null)
    {
        if ($aliases === null) {
            /** @var array<non-empty-string, class-string> $aliases */
            $aliases = class_exists(ClassAliasRegistry::class) ? ClassAliasRegistry::ALIASES : [];
        }

        $normalizedAliases = [];
        foreach ($aliases as $previousClassName => $canonicalClassName) {
            $normalizedAliases[strtolower($previousClassName)] = $canonicalClassName;
        }

        $this->aliases = $normalizedAliases;
    }

    public function error(Name $name, Scope $scope): ?IdentifierRuleError
    {
        $className = $scope->resolveName($name);
        $canonicalClassName = $this->aliases[strtolower($className)] ?? null;
        if ($canonicalClassName === null) {
            return null;
        }

        return RuleErrorBuilder::message(sprintf(
            'Class "%s" moved to "%s". Use the new name now.',
            $className,
            $canonicalClassName,
        ))
            ->identifier('contena.futureIncompatibility.classMoved')
            ->line($name->getStartLine())
            ->build();
    }
}
