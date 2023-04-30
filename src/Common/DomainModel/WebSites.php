<?php

declare(strict_types=1);

namespace Common\DomainModel;

use Psalm\Immutable;

#[Immutable]
class WebSites extends ValueObject
{
    public function __construct(public readonly string $site)
    {
        $this->guard($this->site);
    }

    /**
     * @throws WebSiteException
     */
    private function guard(string $site): void
    {
        if (false === filter_var($site, FILTER_VALIDATE_DOMAIN)) {
            throw WebSiteException::withInvalidValue($site);
        }
    }

    public function __toString(): string
    {
        return $this->site;
    }
}
