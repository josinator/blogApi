<?php

namespace Common\Domain;


use Psalm\Immutable;

#[Immutable]
class Address extends ValueObject
{
    private function __construct(
        public readonly string $street,
        public readonly string $suit,
        public readonly string $city,
        public readonly ZipCode $zipCode,
    )
    {
    }


    public static function build(array $address):self
    {
        try {
            $street = $address['street'];
            $suit = $address['suite'];
            $city = $address['city'];
            $zipCode = new ZipCode($address['zipcode']);
            return new self($street, $suit, $city, $zipCode );
        }catch (ZipCodeException $e){
            throw $e;
        }catch (\Throwable){
            throw AddressException::withNoValidData($address);
        }

    }


}