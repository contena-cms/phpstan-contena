<?php

declare(strict_types=1);

namespace Contena\PhpStan\Tests\Rule;

use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use Contena\PhpStan\Rule\InternalClassExtendsRule;

class InternalClassExtendsRuleTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new InternalClassExtendsRule($this->createReflectionProvider());
    }

    public function testInternalClassExtendsRule(): void
    {
        $this->analyse([__DIR__ . '/fixtures/InternalClassExtendsRule/internal-class.php'], [
            [
                'Class PublicController extends internal class InternalController. Please refrain from extending classes which are annotated with @internal.',
                10,
            ],
        ]);
    }
}
