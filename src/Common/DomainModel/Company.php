<?php

declare(strict_types=1);

namespace Common\DomainModel;

use Psalm\Immutable;

#[Immutable]
class Company extends ValueObject
{
    private function __construct(public readonly string $name)
    {
    }

    public static function build(array $company): self
    {
        try {
            $companyName = $company['name'];

            return new self($companyName);
        } catch (\Throwable) {
            throw CompanyException::withInvalidData($company);
        }

    }
}
