<?php

namespace Blog\DomainModel;

use Doctrine\DBAL\Exception;
use phpDocumentor\Reflection\Types\Self_;

class PostException extends Exception
{

    public static function withEmptyTitle():self
    {
        return  new self("Try to create a Post with empty Title");
    }

    public static function withEmptyDescription():self
    {
        return new self("Try to create a Post with empty Description");
    }

    public static function withToShortDescription()
    {
        return new self("Try to create a Post with to short description");
    }


}