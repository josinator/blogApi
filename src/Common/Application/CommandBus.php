<?php

namespace Common\Application;

interface CommandBus
{
    public function handle(Command $command);
}