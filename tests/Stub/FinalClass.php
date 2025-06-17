<?php
/**
 * Final class for testing Z-Engine functionality
 */
declare(strict_types=1);

namespace ZEngine\Stub;

final class FinalClass
{
    private string $message;

    public function __construct(string $message = 'Hello from FinalClass!')
    {
        $this->message = $message;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
}