<?php

namespace Common\Domain;

class EmailException extends \Exception
{

    public static function withInvalidValue(string $email)
    {
        return new self(sprintf("Try to create Email with invalid value %s", $email));
    }
}