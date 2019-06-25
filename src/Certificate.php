<?php

declare(strict_types=1);

namespace Proget;

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

    public function publicKey(): string
    {
        return $this->publicKey;
    }

    public function privateKeyPem(): string
    {
        return "-----BEGIN RSA PRIVATE KEY-----\n".$this->privateKey."\n-----END RSA PRIVATE KEY-----";
    }
}
