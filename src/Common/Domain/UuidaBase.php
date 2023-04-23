<?php

namespace Common\Domain;


use Psalm\Immutable;
use Psalm\Pure;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

#[Immutable]
class UuidaBase extends ValueObject
{
    protected UuidInterface $id;
    protected UuidInterface $string;

    private function __construct(UuidInterface $id)
    {
        $this->id = $this->string = $id;
    }

    /** @psalm-return static */
    final public static function new(): static
    {
        return static::fromUuid(Uuid::uuid4());
    }

    #[Pure] final public static function fromUuid(UuidInterface $uuid): static
    {
        return new static($uuid);
    }

    #[Pure] final public static function fromString(string $uuid): static
    {
        return new static(Uuid::fromString($uuid));
    }

    #[Pure] final public static function uuid3(string $uuid): static
    {
        return new static(Uuid::uuid3(Uuid::NAMESPACE_URL, $uuid));
    }

    final public function equals(self $other): bool
    {
        return $this->id->equals($other->id);
    }

    final public function toString(): string
    {
        return $this->__toString();
    }

    public function __toString(): string
    {
        return $this->id->toString();
    }

    final public function id(): UuidInterface
    {
        return $this->id;
    }

}