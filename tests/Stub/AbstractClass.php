<?php
/**
 * Final class for testing Z-Engine functionality
 */
declare(strict_types=1);

namespace ZEngine\Stub;

abstract class AbstractClass
{
    private string $message;

    public function __construct(string $message = 'Hello from AbstractClass!')
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