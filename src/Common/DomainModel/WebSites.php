<?php

declare(strict_types=1);

namespace Common\DomainModel;

use Psalm\Immutable;

#[Immutable]
class WebSites extends ValueObject
{
    private string $site;

    public function __construct(string $site)
    {
        $this->guard($site);
        $this->site = $site;
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

    public function getSite(): string
    {
        return $this->site;
    }

    public function __toString(): string
    {
        return $this->site;
    }
}
