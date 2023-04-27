<?php

declare(strict_types=1);

namespace Common\Infrastructure\Application;

use Common\Application\Command;
use Common\Application\CommandBus;
use Symfony\Component\Messenger\MessageBusInterface;

final class SymfonyMessengerCommandBus implements CommandBus
{
    public function __construct(
        private MessageBusInterface $commandBus
    ) {
    }

    public function handle(Command $command)
    {
        return $this->commandBus->dispatch($command);
    }
}
