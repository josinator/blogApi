<?php

namespace Common\DomainModel;

use Exception;

class AddressException extends Exception
{

    public static function withNoValidData(array $address)
    {
        return new self(sprintf("Try to create an Address with no valid data: %s", json_encode($address)));
    }
}