<?php

namespace Blog\Application\DTO;

use Common\DomainModel\Address;

class AddressDto
{

    private function __construct(
        public readonly string $street,
        public readonly string $suit,
        public readonly string $city,
        public readonly string $zipCode
    )
    {
    }

    public static function buildFromAddress(Address $address):self
    {
        return new self(
          $address->street,
          $address->suit,
          $address->city,
          $address->zipCode->zipcode
        );
    }

}