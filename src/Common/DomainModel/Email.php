<?php

declare(strict_types=1);

namespace Common\DomainModel;

use Psalm\Immutable;

#[Immutable]
class Email extends ValueObject
{
    public function __construct(private string $email)
    {
        $this->guard($this->email);
    }

    private function guard(string $email): void
    {
        if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw EmailException::withInvalidValue($email);
        }
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function __toString(): string
    {
        return $this->email;
    }
}
