<?php

declare(strict_types=1);

namespace Blog\DomainModel;

class AuthorException extends \Exception
{
    public static function withEmptyName()
    {
        return new self('Try to create an Author with empty Name');
    }

    public static function withEmptyUserName()
    {
        return new self('Try to create an Author with empty UserName');
    }

    public static function withData(array $author)
    {
        return new self(sprintf('Try to create an Author with data: %s', json_encode($author)));
    }
}
