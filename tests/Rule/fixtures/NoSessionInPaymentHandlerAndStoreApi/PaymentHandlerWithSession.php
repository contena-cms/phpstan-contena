<?php

declare(strict_types=1);

namespace Contena\PhpStan\Tests\Rule\Fixtures\NoSessionInPaymentHandlerAndStoreApi;

use Contena\Core\Checkout\Payment\Cart\PaymentHandler\AbstractPaymentHandler;
use Contena\Core\Checkout\Payment\Cart\PaymentHandler\PaymentHandlerInterface;
use Contena\Core\Checkout\Payment\Cart\PaymentHandler\PaymentHandlerType;
use Contena\Core\Checkout\Payment\Cart\PaymentTransactionStruct;
use Contena\Core\Framework\Context;
use Contena\Core\Framework\Struct\Struct;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PaymentHandlerWithSession extends AbstractPaymentHandler implements PaymentHandlerInterface
{
    public function __construct(
        private readonly SessionInterface $session,
    ) {}

    public function pay(Request $request, PaymentTransactionStruct $transaction, Context $context, ?Struct $validateStruct = null): ?RedirectResponse
    {
        $this->session->get('foo');

        return null;
    }

    public function supports(PaymentHandlerType $type, string $paymentMethodId, Context $context): bool
    {
        return true;
    }
}
