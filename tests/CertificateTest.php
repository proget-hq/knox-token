<?php

declare(strict_types=1);

namespace Proget\Tests\Samsung\KnoxToken;

use PHPUnit\Framework\TestCase;
use Proget\Samsung\KnoxToken\Certificate;

class CertificateTest extends TestCase
{
    public function testLoad(): void
    {
        $certificate = Certificate::fromPath(__DIR__.'/keys.json');

        self::assertEquals(204, \strlen($certificate->publicKey()));
        self::assertEquals(886, \strlen($certificate->privateKeyPem()));
    }

    public function testLoadFromInvalidPath(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Missing certificate file at /some/invalid/path');

        Certificate::fromPath('/some/invalid/path');
    }

    public function testLoadFromInvalidFile(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Invalid certificate file at '.__FILE__);

        Certificate::fromPath(__FILE__);
    }
}
