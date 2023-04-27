<?php

declare(strict_types=1);

namespace Common\DomainModel;

use Psalm\Immutable;

#[Immutable]
class Phone extends ValueObject
{
    public function __construct(public readonly string $phone)
    {
    }

    public function __toString(): string
    {
        return $this->phone;
    }
}
