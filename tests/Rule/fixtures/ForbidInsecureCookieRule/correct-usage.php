<?php

declare(strict_types=1);

namespace Contena\PhpStan\Tests\Rule\fixtures\ForbidInsecureCookieRule;

class CorrectUsage
{
    public function setcookieWithSecureTrue(): void
    {
        setcookie('session', 'abc123', 0, '/', '', true);
    }

    public function setcookieArrayOptionsWithSecure(): void
    {
        setcookie('session', 'abc123', ['expires' => 0, 'path' => '/', 'secure' => true]);
    }
}
