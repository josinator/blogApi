<?php

declare(strict_types=1);

namespace Blog\Application\Command;

use Common\Application\Command;

class CreateAuthorCommand implements Command
{
    /**
     * @param mixed $author
     */
    public function __construct(public readonly array $author)
    {
    }
}
