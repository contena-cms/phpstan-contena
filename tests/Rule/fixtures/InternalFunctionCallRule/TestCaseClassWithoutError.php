<?php

declare(strict_types=1);

namespace Contena\PhpStan\Tests\Rule\fixtures\InternalFunctionCallRule;

class TestCaseClassWithoutError
{
    public function something(): void
    {
        internalFunction();
    }
}
