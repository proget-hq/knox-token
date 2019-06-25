<?php

declare(strict_types=1);

namespace Proget;

use Firebase\JWT\JWT;
use Ramsey\Uuid\Uuid;

class KnoxToken
{
    private const AUDIENCE = 'KnoxWSM';

    public static function signClientIdentifier(string $clientIdentifier, string $certificatePath): string
    {
        $certificate = self::loadCertificate($certificatePath);

        return JWT::encode([
            'clientIdentifier' => $clientIdentifier,
            'publicKey' => $certificate->publicKey(),
            'aud' => self::AUDIENCE,
            'jti' => Uuid::uuid1()->toString().Uuid::uuid1()->toString()
        ], $certificate->privateKeyPem(), 'RS512');
    }

    public static function signAccessToken(string $accessToken, string $certificatePath): string
    {
        $certificate = self::loadCertificate($certificatePath);

        return JWT::encode([
            'accessToken' => $accessToken,
            'publicKey' => $certificate->publicKey(),
            'aud' => self::AUDIENCE,
            'jti' => Uuid::uuid1()->toString().Uuid::uuid1()->toString()
        ], $certificate->privateKeyPem(), 'RS512');
    }

    public static function loadCertificate(string $certificatePath): Certificate
    {
        if (!file_exists($certificatePath)) {
            throw new \RuntimeException(sprintf('Missing certificate file at %s', $certificatePath));
        }
        $certificate = json_decode(file_get_contents($certificatePath), true);

        if (!isset($certificate['Public'], $certificate['Private'])) {
            throw new \RuntimeException(sprintf('Invalid certificate file at %s', $certificatePath));
        }

        return new Certificate($certificate['Public'], $certificate['Private']);
    }
}
