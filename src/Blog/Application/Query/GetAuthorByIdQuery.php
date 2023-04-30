<?php

declare(strict_types=1);

namespace Blog\Application\Query;

use Common\Application\Query;

class GetAuthorByIdQuery implements Query
{
    public function __construct(public readonly int $id)
    {
    }
}
