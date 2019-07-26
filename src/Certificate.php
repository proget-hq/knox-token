<?php

declare(strict_types=1);

namespace Proget\Samsung\KnoxToken;

class Certificate
{
    /**
     * @var string
     */
    private $publicKey;

    /**
     * @var string
     */
    private $privateKey;

    public function __construct(string $publicKey, string $privateKey)
    {
        $this->publicKey = $publicKey;
        $this->privateKey = $privateKey;
    }

    public static function fromPath(string $certificatePath): Certificate
    {
        if (!\file_exists($certificatePath)) {
            throw new \RuntimeException(\sprintf('Missing certificate file at %s', $certificatePath));
        }

        $certificate = \json_decode(\file_get_contents($certificatePath), true);
        if (!isset($certificate['Public'], $certificate['Private'])) {
            throw new \RuntimeException(\sprintf('Invalid certificate file at %s', $certificatePath));
        }

        return new Certificate($certificate['Public'], $certificate['Private']);
    }

    public function publicKey(): string
    {
        return $this->publicKey;
    }

    public function privateKeyPem(): string
    {
        return "-----BEGIN RSA PRIVATE KEY-----\n".$this->privateKey."\n-----END RSA PRIVATE KEY-----";
    }
}
