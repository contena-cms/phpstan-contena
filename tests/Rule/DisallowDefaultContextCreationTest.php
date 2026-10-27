<?php

declare(strict_types=1);

namespace Contena\PhpStan\Tests\Rule;

use PHPStan\Rules\Rule;
use Contena\PhpStan\Rule\DisallowDefaultContextCreation;
use PHPStan\Testing\RuleTestCase;

/**
 * @internal
 *
 * @extends  RuleTestCase<DisallowDefaultContextCreation>
 */
class DisallowDefaultContextCreationTest extends RuleTestCase
{
    public function testAnalyse(): void
    {
        $this->analyse([__DIR__ . '/fixtures/DisallowDefaultContextCreation/context.php'], [
            [
                <<<EOF
Do not use Contena\Core\Framework\Context::createDefaultContext() function in code.
    💡 • If you are in a CLI context, use %s::createCLIContext() instead.
• If you are in a web context, pass down the context from the controller.
EOF,
                5,
            ],
        ]);
    }

    protected function getRule(): Rule
    {
        return new DisallowDefaultContextCreation(self::createReflectionProvider());
    }
}
