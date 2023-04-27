<?php

declare(strict_types=1);

namespace Common\DomainModel;

class WebSiteException extends \Exception
{
    public static function withInvalidValue(string $site): self
    {
        return new self(sprintf('Try to create WebSite with invalid value %s', $site));
    }
}
