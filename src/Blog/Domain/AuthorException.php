<?php

namespace Blog\Domain;

class AuthorException extends \Exception
{


    public static function withEmptyName()
    {
        return new self("Try to create an Author with empty Name");
    }

    public static function withEmptyUserName()
    {
        return new self("Try to create an Author with empty UserName");
    }
}