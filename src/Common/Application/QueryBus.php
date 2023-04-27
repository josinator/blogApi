<?php

declare(strict_types=1);

namespace Common\Application;

interface QueryBus
{
    public function handle(Query $query);
}
