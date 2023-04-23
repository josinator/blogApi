<?php

namespace Common\Domain;
use Psalm\Immutable;

#[Immutable]
class Email extends ValueObject
{

    private string $email;
    public function __construct(string $email)
    {
        $this->guard($email);
    }


    private function guard(string $email)
    {
        if(filter_var($email,FILTER_VALIDATE_EMAIL) === false){
            throw EmailException::withInvalidValue($email);
        }
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function __toString(): string
    {
        return $this->email;
    }

}