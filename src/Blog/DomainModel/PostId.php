<?php

namespace Blog\DomainModel;

use Psalm\Immutable;
use Common\DomainModel\UuidBase;

#[Immutable]
class PostId extends UuidBase
{

}