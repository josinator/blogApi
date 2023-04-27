<?php

declare(strict_types=1);

namespace Common\DomainModel;

use mysql_xdevapi\Exception;

class ZipCodeException extends Exception
{
    public static function withInvalididCode(string $zipcode)
    {
        return new self(sprintf('Try to create ZipCode with invalid data: %s', $zipcode));
    }
}
