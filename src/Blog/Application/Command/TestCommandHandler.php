<?php

namespace Blog\Application\Command;

class TestCommandHandler
{

    public function __invoke(TestCommand $command)
    {
        dd($command);
    }

}