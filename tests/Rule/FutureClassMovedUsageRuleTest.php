<?php

declare(strict_types=1);

namespace Contena\PhpStan\Tests\Rule;

use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use Contena\PhpStan\Rule\FutureCompatibility\ClassMovedUsage;
use Contena\PhpStan\Rule\FutureCompatibility\FutureClassMovedUsageRule;
use Contena\PhpStan\Tests\Fixture\FutureClassMovedUsageRule\Canonical\MovedSubject;

/**
 * @extends RuleTestCase<FutureClassMovedUsageRule>
 * @internal
 */
class FutureClassMovedUsageRuleTest extends RuleTestCase
{
    public function testReportsOldClassNames(): void
    {
        $message = 'Class "Contena\\PhpStan\\Tests\\Fixture\\FutureClassMovedUsageRule\\Legacy\\MovedSubject" moved to "Contena\\PhpStan\\Tests\\Fixture\\FutureClassMovedUsageRule\\Canonical\\MovedSubject". Use the new name now.';

        $this->analyse([__DIR__ . '/fixtures/FutureClassMovedUsageRule/usage.php'], [
            [$message, 12],
            [$message, 16],
            [$message, 16],
            [$message, 19],
            [$message, 32],
        ]);
    }

    protected function getRule(): Rule
    {
        return new FutureClassMovedUsageRule(new ClassMovedUsage([
            'Contena\\PhpStan\\Tests\\Fixture\\FutureClassMovedUsageRule\\Legacy\\MovedSubject' => MovedSubject::class,
        ]));
    }
}
