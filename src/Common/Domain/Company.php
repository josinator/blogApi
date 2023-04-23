<?php

namespace Common\Domain;
use Psalm\Immutable;

#[Immutable]
class Company extends ValueObject
{

    private function __construct(string $name)
    {
    }

    public static function build(array $company):self
    {
        try{
            $companyName = $company['name'];
            return new self($companyName);
        }catch (\Throwable){
            throw CompanyException::withInvalidData($company);
        }

    }
}