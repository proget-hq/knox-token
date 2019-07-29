<?php

declare(strict_types=1);

namespace Proget\Tests\Samsung\KnoxToken;

use PHPUnit\Framework\TestCase;
use Proget\Samsung\KnoxToken\Certificate;
use Proget\Samsung\KnoxToken\KnoxToken;

class KnoxTokenTest extends TestCase
{
    public function testSignClientIdentifier(): void
    {
        self::assertEquals(713, \strlen(KnoxToken::signClientIdentifier(
            'a33a7593-dbaf-457f-87be-19243a421aec',
            Certificate::fromPath(__DIR__.'/keys.json')
        )));
    }

    public function testSignAccessToken(): void
    {
        self::assertEquals(707, \strlen(KnoxToken::signAccessToken(
            'd13d112e-8e77-4243-b795-ed4e1cf15cf9',
            Certificate::fromPath(__DIR__.'/keys.json')
        )));
    }
}
