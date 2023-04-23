<?php

namespace Common\Domain;


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