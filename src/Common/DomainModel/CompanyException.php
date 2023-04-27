<?php

declare(strict_types=1);

namespace Common\DomainModel;

class CompanyException extends \Exception
{
    public static function withInvalidData(array $company)
    {
        return new self(sprintf('Try to create a company with invalid data %s', json_encode($company)));
    }
}
