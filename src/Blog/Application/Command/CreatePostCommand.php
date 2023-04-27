<?php

declare(strict_types=1);

namespace Blog\Application\Command;

use Common\Application\Command;

class CreatePostCommand implements Command
{
    public function __construct(public readonly array $post)
    {
    }
}
