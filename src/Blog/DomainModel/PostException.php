<?php

declare(strict_types=1);

namespace Blog\DomainModel;

use Doctrine\DBAL\Exception;
use Psalm\Immutable;

#[Immutable]
class PostException extends Exception
{
    public static function withEmptyTitle(): self
    {
        return new self('Try to create a Post with empty Title');
    }

    public static function withEmptyDescription(): self
    {
        return new self('Try to create a Post with empty Description');
    }

    public static function withToShortDescription()
    {
        return new self('Try to create a Post with to short description');
    }

    public static function notPostFoundForId(int $id)
    {
        return new self(sprintf('No post found for Id: %s', $id));
    }
}
