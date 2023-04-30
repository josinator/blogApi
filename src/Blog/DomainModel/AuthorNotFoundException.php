<?php

namespace Blog\DomainModel;

use Exception;

class AuthorNotFoundException extends Exception
{
    public static function withId(int $id):self
    {
        return new self(sprintf("Author not found for authorId: %s", strval($id)));
    }

}