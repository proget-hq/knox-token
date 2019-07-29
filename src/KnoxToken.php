<?php

declare(strict_types=1);

namespace Proget\Samsung\KnoxToken;

use Firebase\JWT\JWT;
use Ramsey\Uuid\Uuid;

class KnoxToken
{
    private const AUDIENCE = 'KnoxWSM';

    public static function signClientIdentifier(string $clientIdentifier, Certificate $certificate): string
    {
        return JWT::encode([
            'clientIdentifier' => $clientIdentifier,
            'publicKey' => $certificate->publicKey(),
            'aud' => self::AUDIENCE,
            'jti' => Uuid::uuid1()->toString().Uuid::uuid1()->toString()
        ], $certificate->privateKeyPem(), 'RS512');
    }

    public static function signAccessToken(string $accessToken, Certificate $certificate): string
    {
        return JWT::encode([
            'accessToken' => $accessToken,
            'publicKey' => $certificate->publicKey(),
            'aud' => self::AUDIENCE,
            'jti' => Uuid::uuid1()->toString().Uuid::uuid1()->toString()
        ], $certificate->privateKeyPem(), 'RS512');
    }
}
