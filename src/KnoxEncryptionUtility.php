<?php

declare(strict_types=1);

namespace Proget\Samsung\KnoxToken;

use phpseclib3\Crypt\PublicKeyLoader;
use phpseclib3\Crypt\RSA;
use phpseclib3\Crypt\RSA\PublicKey;
use RuntimeException;

class KnoxEncryptionUtility
{
    private const ENCRYPTION_PUBLIC_KEY = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAu4NECyudg9kYyLqdcfaOiRY+ImD3PYpnMXItzWR9YL1BeJOt1lwLG32aIix2SvED+5w8q0aLINeS8zDiJ28gsz5waUSIZHDzuPg9GOaDumua6FWcXxqI1i209lPF7rzbtHWU/2AngPX/hb5a/L7nYuTpDTNFMvQ1k1xw3fghtUb5lP+tRPYIgdKjRdS5WCRCR3I8ppyKABFisYHn1jm0op16AyIyX6lbCTb7HppkfDU2V0tdPBqTT5C1qNJKkPVLQzqN3lKQdY0bx+Ebf9zA+QPeorTTGurmnAe4JuNYO3G26WtFZ91RaMaKXogT1l+2++oaoSGZk1fm6z2ojLdz4wIDAQAB';

    private static ?PublicKey $key = null;

    public static function encrypt(string $text): string
    {
        if (\is_bool($encrypted = self::getKey()->encrypt($text))) {
            throw new RuntimeException('Encryption failed');
        }

        return \base64_encode($encrypted);
    }

    private static function getKey(): PublicKey
    {
        if (null !== self::$key) {
            return self::$key;
        }

        if (!\class_exists(PublicKey::class)) {
            throw new RuntimeException(
                'To use Knox Encryption Utility, you must install phpseclib/phpseclib.'
            );
        }

        $publicKey = PublicKeyLoader::loadPublicKey(self::ENCRYPTION_PUBLIC_KEY);

        // Make PHP stan happy.
        if (!$publicKey instanceof RSA) {
            throw new RuntimeException('Unexpected key type.');
        }

        return self::$key = $publicKey->withPadding(RSA::ENCRYPTION_PKCS1);
    }
}
