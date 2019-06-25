<?php

declare(strict_types=1);

namespace Proget\Tests;

use PHPUnit\Framework\TestCase;
use Proget\Certificate;
use Proget\KnoxToken;

class KnoxTokenTest extends TestCase
{
    public function testSignClientIdentifier(): void
    {
        self::assertEquals(713, strlen(KnoxToken::signClientIdentifier(
            'a33a7593-dbaf-457f-87be-19243a421aec',
            __DIR__.'/keys.json'
        )));
    }

    public function testSignAccessToken(): void
    {
        self::assertEquals(707, strlen(KnoxToken::signAccessToken(
            'd13d112e-8e77-4243-b795-ed4e1cf15cf9',
            __DIR__.'/keys.json'
        )));
    }

    public function testLoadCertificate(): void
    {
        $certificate = KnoxToken::loadCertificate(__DIR__.'/keys.json');

        self::assertInstanceOf(Certificate::class, $certificate);
        self::assertEquals(204, strlen($certificate->publicKey()));
        self::assertEquals(886, strlen($certificate->privateKeyPem()));
    }

    public function testLoadCertificateInvalidPath(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Missing certificate file at /some/invalid/path');

        KnoxToken::signAccessToken('access-token', '/some/invalid/path');
    }

    public function testLoadCertificateInvalidFile(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Invalid certificate file at '.__FILE__);

        KnoxToken::signAccessToken('access-token', __FILE__);
    }
}
