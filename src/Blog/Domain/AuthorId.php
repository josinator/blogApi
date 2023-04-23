<?php

namespace Blog\Domain;

use Psalm\Immutable;
use Common\Domain\UuidaBase;

#[Immutable]
class AuthorId extends UuidaBase
{
}