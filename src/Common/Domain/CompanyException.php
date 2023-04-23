<?php

namespace Common\Domain;

use Exception;

class CompanyException extends Exception
{

    public static function withInvalidData(array $company)
    {
        return new self(sprintf("Try to create a company with invalid data %s", json_encode($company)));
    }
}