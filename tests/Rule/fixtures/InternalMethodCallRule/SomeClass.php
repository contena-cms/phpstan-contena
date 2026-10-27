<?php

declare(strict_types=1);

namespace Contena\PhpStan\Tests\Rule\fixtures\InternalMethodCallRule;

class SomeClass
{
    /**
     * @internal
     */
    public function internalMethod(): void {}
}
