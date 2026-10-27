<?php

declare(strict_types=1);

namespace Test\App;

use Contena\PhpStan\Tests\Rule\fixtures\InternalMethodCallRule\SomeClass;

function test()
{
    (new SomeClass())->internalMethod();
}
