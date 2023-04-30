<?php

declare(strict_types=1);

namespace Blog\Application\DTO;

use Common\DomainModel\Address;

class AddressDto
{
    private function __construct(
        public readonly string $street,
        public readonly string $suit,
        public readonly string $city,
        public readonly string $zipCode
    ) {
    }

    public static function buildFromAddress(Address $address): self
    {
        return new self(
            $address->street,
            $address->suit,
            $address->city,
            $address->zipCode->zipcode
        );
    }

    public function __serialize(): array
    {
        return [
          'street' => $this->street,
          'suit' => $this->suit,
          'city' => $this->city,
          'zipcode' => $this->zipCode,
        ];
    }
}
