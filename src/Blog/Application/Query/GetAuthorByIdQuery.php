<?php

namespace Blog\Application\Query;

use Common\Application\Query;

class GetAuthorByIdQuery implements Query
{

    /**
     * @param int $id
     */
    public function __construct(public readonly int $id)
    {
    }
}