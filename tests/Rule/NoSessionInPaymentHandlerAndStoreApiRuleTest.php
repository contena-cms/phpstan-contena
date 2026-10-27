<?php

declare(strict_types=1);

namespace Contena\PhpStan\Tests\Rule;

use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use Contena\PhpStan\Rule\NoSessionInPaymentHandlerAndStoreApiRule;

/**
 * @extends RuleTestCase<NoSessionInPaymentHandlerAndStoreApiRule>
 */
class NoSessionInPaymentHandlerAndStoreApiRuleTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new NoSessionInPaymentHandlerAndStoreApiRule();
    }

    public function testRule(): void
    {
        $this->analyse([__DIR__ . '/fixtures/NoSessionInPaymentHandlerAndStoreApi/PaymentHandlerWithSession.php'], [
            [
                'Session usage is not allowed in payment handlers.',
                25,
            ],
        ]);

        $this->analyse([__DIR__ . '/fixtures/NoSessionInPaymentHandlerAndStoreApi/StoreApiControllerWithSession.php'], [
            [
                'Session usage is not allowed in Store-API controllers.',
                20,
            ],
        ]);
    }
}
