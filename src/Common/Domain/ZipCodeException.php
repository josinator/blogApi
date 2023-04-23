<?php

namespace Common\Domain;

use mysql_xdevapi\Exception;

class ZipCodeException extends Exception
{

    public static function withInvalididCode(string $zipcode)
    {
        return new self(sprintf('Try to create ZipCode with invalid data: %s', $zipcode));
    }
}