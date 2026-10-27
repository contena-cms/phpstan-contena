<?php

declare(strict_types=1);

namespace Contena\PhpStan\Rule;

use PhpParser\Node;
use PhpParser\NodeFinder;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;
use Contena\Core\Framework\Migration\MigrationStep;
use Contena\Core\Framework\Plugin;

/**
 * @implements Rule<Node\Stmt\ClassMethod>
 *
 * @internal
 */
class SetForeignKeyRule implements Rule
{
    public function getNodeType(): string
    {
        return Node\Stmt\ClassMethod::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        if ($node->name->name !== 'update') {
            return [];
        }

        $class = $scope->getClassReflection();

        if ($class === null) {
            return [];
        }

        if ($class->getParentClass()?->getName() !== MigrationStep::class && $class->getParentClass()?->getName() !== Plugin::class) {
            return [];
        }

        $finder = new NodeFinder();

        $strings = $finder->findInstanceOf($node->stmts ?? [], Node\Scalar\String_::class);

        $errors = [];

        foreach ($strings as $string) {
            if (str_contains($string->value, 'FOREIGN_KEY_CHECKS')) {
                $errors[] = RuleErrorBuilder::message('Do not disable FOREIGN KEY checks in migrations. Delete the data in the right order')
                    ->line($string->getLine())
                    ->identifier('contena.foreign.key.checks')
                    ->build();
            }
        }

        return $errors;
    }
}
