<?php

declare(strict_types=1);

namespace Proget;

class Certificate
{
    /**
     * @var string
     */
    private $public;

    /**
     * @var string
     */
    private $private;

    public function __construct(string $public, string $private)
    {
        $this->public = $public;
        $this->private = $private;
    }

    public function public(): string
    {
        return $this->public;
    }

    public function privatePem(): string
    {
        return "-----BEGIN RSA PRIVATE KEY-----\n".$this->private."\n-----END RSA PRIVATE KEY-----";
    }
}
