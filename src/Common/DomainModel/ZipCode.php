<?php

namespace Common\DomainModel;
use Psalm\Immutable;

#[Immutable]
class ZipCode extends ValueObject
{

    public function __construct(public readonly string $zipcode)
    {
        $this->guard($this->zipcode);
    }

    private function guard(string $zipcode)
    {
        if(empty($zipcode)){
            throw ZipCodeException::withInvalididCode($zipcode);
        }
    }

    public function __toString(): string
    {
        return $this->zipcode;
    }


}