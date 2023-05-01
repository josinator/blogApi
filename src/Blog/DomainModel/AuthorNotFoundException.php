<?php

declare(strict_types=1);

namespace Blog\DomainModel;

class AuthorNotFoundException extends \Exception
{
    public static function withId(int $id): self
    {
        return new self(sprintf('Author not found for authorId: %s', strval($id)));
    }
}
