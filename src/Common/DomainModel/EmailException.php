<?php

namespace Common\DomainModel;

class EmailException extends \Exception
{

    public static function withInvalidValue(string $email)
    {
        return new self(sprintf("Try to create Email with invalid value %s", $email));
    }
}