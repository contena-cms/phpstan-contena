<?php

declare(strict_types=1);

namespace Contena\PhpStan\Tests\Rule;

use PHPStan\Testing\RuleTestCase;
use PHPStan\Rules\Rule;
use Contena\PhpStan\Rule\ForbidGlobBraceRule;

/**
 * @extends RuleTestCase<ForbidGlobBraceRule>
 */
final class ForbidGlobBraceRuleTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new ForbidGlobBraceRule();
    }

    public function testRule(): void
    {
        $this->analyse([__DIR__ . '/fixtures/ForbidGlobBraceRule/glob.php'], [
            [
                'Usage of GLOB_BRACE constant is forbidden. GLOB_BRACE is not supported on any platform.',
                5,
            ],
            [
                'Usage of GLOB_BRACE constant is forbidden. GLOB_BRACE is not supported on any platform.',
                8,
            ],
        ]);
    }
}
