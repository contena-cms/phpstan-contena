<?php

declare(strict_types=1);

namespace Contena\PhpStan\Tests\Rule;

use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use Contena\PhpStan\Rule\FutureCompatibility\ClassMovedUsage;
use Contena\PhpStan\Rule\FutureCompatibility\FutureClassMovedExpressionUsageRule;
use Contena\PhpStan\Tests\Fixture\FutureClassMovedUsageRule\Canonical\MovedSubject;

/**
 * @extends RuleTestCase<FutureClassMovedExpressionUsageRule>
 * @internal
 */
class FutureClassMovedExpressionUsageRuleTest extends RuleTestCase
{
    public function testReportsOldClassNamesInExpressions(): void
    {
        $message = 'Class "Contena\\PhpStan\\Tests\\Fixture\\FutureClassMovedUsageRule\\Legacy\\MovedSubject" moved to "Contena\\PhpStan\\Tests\\Fixture\\FutureClassMovedUsageRule\\Canonical\\MovedSubject". Use the new name now.';

        $this->analyse([__DIR__ . '/fixtures/FutureClassMovedUsageRule/usage.php'], [
            [$message, 18],
            [$message, 21],
            [$message, 22],
            [$message, 23],
            [$message, 34],
        ]);
    }

    protected function getRule(): Rule
    {
        return new FutureClassMovedExpressionUsageRule(new ClassMovedUsage([
            'Contena\\PhpStan\\Tests\\Fixture\\FutureClassMovedUsageRule\\Legacy\\MovedSubject' => MovedSubject::class,
        ]));
    }
}
