<?php

declare(strict_types=1);

namespace Proget\Tests\Samsung\KnoxToken;

use phpseclib3\Crypt\RSA\PublicKey;
use PHPUnit\Framework\TestCase;
use Proget\Samsung\KnoxToken\KnoxEncryptionUtility;

use RuntimeException;

class KnoxEncryptionUtilityTest extends TestCase
{
    public function testEncrypt(): void
    {
        if (!\class_exists(PublicKey::class)) {
            $this->expectException(RuntimeException::class);
            $this->expectExceptionMessage('To use Knox Encryption Utility, you must install phpseclib/phpseclib.');

            KnoxEncryptionUtility::encrypt('some-secret-value');

            return;
        }

        self::assertEquals(344, \strlen(
            KnoxEncryptionUtility::encrypt('some-secret-value')
        ));
    }
}
