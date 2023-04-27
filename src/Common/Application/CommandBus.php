<?php

declare(strict_types=1);

namespace Common\Application;

interface CommandBus
{
    public function handle(Command $command);
}
